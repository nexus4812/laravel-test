<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SingUpController extends Controller
{
    public function index()
    {
        return view('singup');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            User::NAME => ['required', 'max:20'],
            User::EMAIL => ['required', 'email', Rule::unique(User::TABLE, User::EMAIL)],
            User::PASSWORD => ['required', 'min:7'],
        ]);

        $user = User::query()->create([
            User::NAME      => $data[User::NAME],
            User::EMAIL     => $data[User::EMAIL],
            User::PASSWORD  => bcrypt($data[User::PASSWORD]),
        ]);

        auth()->login($user);

        return redirect(route('mypage.blogs'));
    }
}
