<?php

namespace App\Http\Controllers\NormalControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('product.product-list');
    }
}
