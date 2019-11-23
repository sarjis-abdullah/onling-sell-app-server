<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Image;
class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'posts' => Post::latest()->get()
        ], 200);
        //return TagRe::collection(Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $image = $request->file('image');
//        $imageName = time() .'_'.$image->getClientOriginalName();
//        $directory = 'images/';
//        $imageUrl = $directory . $imageName;
//        Image::make($image)->resize(900, 632)->save($imageUrl);

        //$aboutUs->image = $imageUrl;
        return post::create([
            'name' => $request->name,
            'description' => $request->description,
            'contact' => $request->contact,
            'address' => $request->address,
            'size' => $request->size,
            'slug' => str_slug($request->name),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = post::findOrFail($id);
        if (!is_null($row)) {
            post::destroy($id);
        }
    }
}
