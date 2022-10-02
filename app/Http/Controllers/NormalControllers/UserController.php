<?php

namespace App\Http\Controllers\NormalControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.user-list');
    }
}
