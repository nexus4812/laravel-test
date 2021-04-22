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
