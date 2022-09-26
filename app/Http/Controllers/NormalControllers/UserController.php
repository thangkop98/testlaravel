<?php

namespace App\Http\Controllers\NormalControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $getUser = User::whereNull('is_admin')->update(['is_admin' => 0]);

        return $getUser;
    }
}
