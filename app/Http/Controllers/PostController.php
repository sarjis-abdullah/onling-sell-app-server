<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Post\PostRepositoryInterface;
use  App\Http\Resources\PostResource;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
//use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $Posts = Post::orderBy('created_at', 'DESC')->paginate(6);;
        return PostResource::collection($Posts);
    }

    public function search(Request $request)
    {
        $posts = $this->postRepository->search($request);
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function imageCustomization($request)
    {
        $url = '';

        $exploded = explode(',', $request);
        $decoded = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'png')) {
            $ext = 'png';
        } else if (str_contains($exploded[0], 'jpeg')) {
            $ext = 'jpeg';
        } else if (str_contains($exploded[0], 'jpg')) {
            $ext = 'jpg';
        } else {
            $ext = 'jpg';
        }
        $image_name = time() . '.' . $ext;

        $upload_path = 'images/';
        $url = $upload_path . $image_name;

        Image::make($request)->resize(100, 100)->save($url);
        Image::make($request)->save($url);
        return $url;
    }

    public function store(Request $request)
    {
        //$this->validation($request);
        $url = $this->imageCustomization($request->image);
        return Post::create($request->except('image') + [
                'image' => $url
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
		//return DB::table('category_post')->where('post_id','=',$id)->get();
        $Posts = Post::where('id','=',$id)->get();
        return PostResource::collection($Posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $row = post::findOrFail($id);
        if (strpos($request->image, 'http://') !== false) {
            $row->name = $request->name;
            $row->description = $request->description;
            $row->contact = $request->contact;
            $row->address = $request->address;
            $row->numberOfBed = $request->numberOfBed;
            $row->numberOfBath = $request->numberOfBath;
            $row->landRange = $request->landRange;
            $row->price = $request->price;
            $row->type = $request->type;
            $row->category_id = $request->category_id;
            $row->update();
            return response()->json([
                'post' => $row
            ], 200);
        }else{
//            if($row->image && $row->image != 'default.png'){
//                unlink($row->image);
//            }
           // post::destroy($id);
            $url = $this->imageCustomization($request->image);
            $row->name = $request->name;
            $row->description = $request->description;
            $row->contact = $request->contact;
            $row->address = $request->address;
            $row->numberOfBed = $request->numberOfBed;
            $row->numberOfBath = $request->numberOfBath;
            $row->landRange = $request->landRange;
            $row->price = $request->price;
            $row->type = $request->type;
            $row->image = $url;
            $row->category_id = $request->category_id;
            $row->update();
            return response()->json([
                'post' => $row
            ], 200);
        }
        $row = post::findOrFail($id);
        return Post::create($request->except('image') + [
                'image' => $request->image
            ]);
        if (!is_null($row)) {
            $row->name = $request->name;
            $row->description = $request->description;
            $row->contact = $request->contact;
            $row->address = $request->address;
            $row->numberOfBed = $request->numberOfBed;
            $row->numberOfBath = $request->numberOfBath;
            $row->landRange = $request->landRange;
            $row->price = $request->price;
            $row->image = $request->image;
            $row->type = $request->type;
            $row->category_id = $request->category_id;
            $row->update();
            return response()->json([
                'post' => $row
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $row = post::findOrFail($id);
        if (!is_null($row)) {
			if($row->image && $row->image != 'default.png'){
			unlink($row->image);
			}
            post::destroy($id);
        }
    }
}
