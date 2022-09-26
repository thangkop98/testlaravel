<?php

use App\Http\Controllers\NormalControllers\LoginController;
use App\Http\Controllers\NormalControllers\UserController;
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

Route::get('user', [UserController::class,'update']);


Route::get('login', [LoginController::class,'getLogin'])->name('login');
Route::post('login', [LoginController::class,'postLogin'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth','prevent-back-history']], function () { 
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});