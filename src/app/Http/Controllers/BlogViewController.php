<?php

namespace App\Http\Controllers;

use App\Models\Queries\BlogQuery;

class BlogViewController extends Controller
{
    public function index()
    {
        $blogs = BlogQuery::newQuery()
            ->onlyStatusOpen()
            ->orderByCommentCountDesc()
            ->withUser()
            ->get();

        return view('index', compact('blogs'));
    }

    public function detail(int $id)
    {
        $blog = BlogQuery::newQuery()
            ->onlyStatusOpen()
            ->whereByPrimaryId($id)
            ->withCommentOldest()
            ->firstOrFail();

        return view('detail', compact('blog'));
    }
}
