<?php

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

Route::get('/', [\App\Http\Controllers\BlogViewController::class, "index"])->name('blog.list');
Route::get('blog/detail/{id}', [\App\Http\Controllers\BlogViewController::class, "detail"])->where('id', '[0-9]+')->name('blog.detail');
Route::get('singup', [\App\Http\Controllers\SingUpController::class, 'index'])->name('singup.get');
Route::post('singup', [\App\Http\Controllers\SingUpController::class, 'store'])->name('singup.post');
Route::get('mypage/blogs', [\App\Http\Controllers\BlogViewController::class, 'index'])->name('mypage.blogs');
Route::get('logout', [\App\Http\Controllers\UserLoginConroller::class, 'logout'])->name('logout');
Route::get('login', [\App\Http\Controllers\UserLoginConroller::class, 'index'])->name('login.get');
Route::post('login', [\App\Http\Controllers\UserLoginConroller::class, 'login'])->name('login.post');
