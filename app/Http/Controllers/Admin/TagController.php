<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get();
        return TagResource::collection($tags);
//        return response()->json([
//            'tags' => Tag::latest()->get()
//        ], 200);
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
        return Tag::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!is_null(Tag::find($id))) {
            return response()->json([
                'tags' => Tag::find($id)
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
        $row = Tag::findOrFail($id);
        if (!is_null($row)) {
            $row->name = $request->name;
            $row->slug = $request->slug;
            $row->update();
            return response()->json([
                'tag' => $row
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
        $row = Tag::findOrFail($id);
        if (!is_null($row)) {
            Tag::destroy($id);
        }
    }
}
