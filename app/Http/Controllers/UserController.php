<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
class UserController extends Controller
{
    /*
        This function renders the login page.
    */
    public function login() {
        return view('auth.login');
    }
    /*
        This function handles the post request of the form in the login page.
    */
    public function postLogin(LoginRequest $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(!Auth::attempt($credentials)) { // if credentials is not correct.
            return back()->withErrors(['credentials is not valid']);
        }
        return redirect()->route('auth.main');
    }
    /*
        This function renders the main page.
    */

    public function renderMainPage() {
        return view('main-page');
    }
    /*
        This function handles the logout process.
    */
    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
