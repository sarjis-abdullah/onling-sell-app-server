<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use \App\Http\Resources\Brand as BrandResource;

class BrandController extends Controller
{

    public function index()
    {
//        return response()->json([
//            'brands' => Brand::all()
//        ], 200);

        return BrandResource::collection(Brand::paginate(5));
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


    public function store(Request $request)
    {
        Brand::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $row = Brand::findOrFail($brand->id);
        if (!is_null($row)) {
            $row->name = $request->name;
            $row->description = $request->description;
            $row->update();
        }
        return response()->json(
            ['message' => 'Data Editing Problem']
        );
    }


    public function destroy(Brand $brand)
    {
        $row = Brand::findOrFail($brand->id);
        if (!is_null($row)) {
            Brand::destroy($brand->id);
        }
        return response()->json(
            ['message' => 'Data Deletion Problem']
        );
    }
}
