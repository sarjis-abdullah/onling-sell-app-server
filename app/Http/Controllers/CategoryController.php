<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function fetchCategoryInfo()
    {
        return response()->json([
            'categories' => Category::all()
        ], 200);
    }
}
