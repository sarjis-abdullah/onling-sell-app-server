<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;

class PostController extends Controller
{
    public function index()
    {
        $Posts = Post::latest()->get();
        return PostResource::collection($Posts);
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
     * @param  \Illuminate\Http\Request $request
     * @return Response
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
        } else {
            $ext = 'jpg';
        }
        $image_name = time() . '.' . $ext;

        $upload_path = public_path().'/images/';
        $url = $upload_path . $image_name;
        return $url;

        /* $semicolonPosition = strpos($request->imageUrl, ';');
        $extracted_string_to_semicolon = substr($request->imageUrl, 0, $semicolonPosition);
        $slesh_separated_string = explode('/', $extracted_string_to_semicolon)[1];
        $image_extension = strtolower($slesh_separated_string);
		return $image_extension;
        if ($image_extension != 'jpg' || $image_extension != 'jpeg' || $image_extension != 'gif') {
            $image_name = time() . '.' . $image_extension;
            $upload_path = 'images/';
            $url = $upload_path . $image_name;
            //Image::make($request->post_image)->resize(200, 200)->save($url);
            Image::make($request->imageUrl)->save($url);
        }
        return $url; */
        //return $image_extension;
    }

    public function store(Request $request)
    {
        //$this->validation($request);
        $url = $this->imageCustomization($request);
        return $url;
//        $image = $request->file('image');
//        $imageName = time() .'_'.$image->getClientOriginalName();
//        $directory = 'images/';
//        $imageUrl = $directory . $imageName;
//        Image::make($image)->resize(900, 632)->save($imageUrl);

        //$aboutUs->image = $imageUrl;
        /* return post::create([
            'name' => $request->name,
            'description' => $request->description,
            'contact' => $request->contact,
            'address' => $request->address,
            'size' => $request->size,
            'slug' => str_slug($request->name),
        ]); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (!is_null(post::find($id))) {
            return response()->json([
                'post' => post::find($id)
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
     * @param  int $id
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
