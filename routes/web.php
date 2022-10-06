<?php

use App\Http\Controllers\NormalControllers\LoginController;
use App\Http\Controllers\NormalControllers\ProfileController;
use App\Http\Controllers\NormalControllers\UserController;
use App\Http\Controllers\NormalControllers\ProductController;
use App\Http\Controllers\NormalControllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome')->middleware('auth');




Route::get('login', [LoginController::class,'getLogin'])->name('login');
Route::post('login', [LoginController::class,'postLogin'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth','prevent-back-history']], function () { 
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('user', [UserController::class,'index'])->name('user.list');

    Route::get('profile', [ProfileController::class,'index'])->name('profile');

    Route::get('product', [ProductController::class,'index'])->name('product');
    Route::get('product-categories', [ProductCategoryController::class,'index'])->name('product.categories');
});