<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
class UserController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(!Auth::attempt($credentials)) {
            return back()->withErrors(['credentials is not valid']);
        }
        return redirect()->route('auth.main');
    }

    public function renderMainPage() {
        return view('main-page');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
