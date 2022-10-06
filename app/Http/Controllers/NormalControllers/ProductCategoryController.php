<?php

namespace App\Http\Controllers\NormalControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function index()
    {
        return view('product-category.product-category-list');
    }
}
