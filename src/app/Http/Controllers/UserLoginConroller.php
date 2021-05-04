<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserLoginConroller extends Controller
{
    public function index(): View | RedirectResponse
    {
        if(auth()->check()) {
            return redirect(route('mypage.blogs'));
        }

        return view('mypage.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            User::EMAIL => ['required', 'email'],
            User::PASSWORD => ['required', 'min:7'],
        ]);

        if(!auth()->attempt($data)) {
            throw ValidationException::withMessages([User::EMAIL => 'ログインに失敗しました']);
        }

        return redirect(route('mypage.blogs'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect(route('blog.list'));
    }
}
