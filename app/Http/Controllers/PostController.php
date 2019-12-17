<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Image;

class PostController extends Controller
{
    public function index()
    {
        $Posts = Post::orderBy('created_at', 'DESC')
                                    ->paginate(6);;
        return PostResource::collection($Posts);
    }

    public function search(Request $request)
    {
        if ($request->categoryId !== null) {
            if ($request->landRange[0] > 0 && $request->landRange[1] > $request->landRange[0]) {
                if ($request->flatRange[0] > 0 && $request->flatRange[1] > $request->flatRange[0]) {
                    if ($request->minPrice < $request->maxPrice) {
                        if ($request->bedRoomNumber != null) {
                            if ($request->bathRoomNumber != null){
                                $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                    ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                    ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                    ->where('category_id', $request->categoryId)
                                    ->where('numberOfBed', $request->bedRoomNumber)
                                    ->where('numberOfBath', $request->bathRoomNumber)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10);
                                return PostResource::collection($Posts);
                            }else{
                                $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                    ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                    ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                    ->where('category_id', $request->categoryId)
                                    ->where('numberOfBed', $request->bedRoomNumber)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10);
                                return PostResource::collection($Posts);
                            }
                        } else if ($request->bathRoomNumber != null){
                            $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                ->where('numberOfBath', $request->bathRoomNumber)
                                ->where('category_id', $request->categoryId)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
                            return PostResource::collection($Posts);
                        }else{
                            $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                ->where('category_id', $request->categoryId)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
                            return PostResource::collection($Posts);
                        }
                    } else {
                        $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                            ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                            ->where('category_id', $request->categoryId)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(5);
                        return PostResource::collection($Posts);
                    }
                } else {
                    $Posts = Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                        ->where('category_id', $request->categoryId)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(5);
                    return PostResource::collection($Posts);
                }
            } else {
                $Posts = Post::where('category_id', $request->categoryId)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
                return PostResource::collection($Posts);
            }
        } else {
            $Posts = Post::orderBy('created_at', 'DESC')->paginate(5);
            return PostResource::collection($Posts);
        }
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

        $upload_path = public_path() . '/images/';
        $url = $upload_path . $image_name;

        Image::make($request)->resize(200, 200)->save($url);
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
		$posts = Post::where('id',$id)->first();
		return $posts;
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
        if (!is_null($row)) {
            $row->name = $request->name;
            $row->description = $request->description;
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
            post::destroy($id);
        }
    }
}
