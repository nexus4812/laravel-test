<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogViewController extends Controller
{
    public function index()
    {
       $blogs = Blog::query()
           ->with('user')
           ->withCount('comments')
           ->orderByDesc('comments_count')
           ->get();

       return view('index',compact('blogs'));
    }
}
