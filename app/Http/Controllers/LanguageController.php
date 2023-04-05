<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class LanguageController extends Controller
{
    /*
    This function changes the language of the system between arabic and english.
    */
    public function change() {
        if(session()->has('locale')) {
            if(session()->get('locale') == 'ar') {
                session()->put('locale', 'en');
            } else {
                session()->put('locale', 'ar');
            }
        } else {
            session()->put('locale', 'en');
        }

        return back();
    }
}
