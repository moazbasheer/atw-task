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
            if(session()->get('locale') == 'ar') { // if current language is arabic, change it to english
                session()->put('locale', 'en');
            } else { // if current language is english, change it to arabic
                session()->put('locale', 'ar');
            }
        } else { // the default language is english
            session()->put('locale', 'en');
        }

        return back();
    }
}
