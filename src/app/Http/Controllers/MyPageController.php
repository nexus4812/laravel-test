<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MyPageController extends Controller
{
    public function index()
    {
        return view('singup');
    }
}
