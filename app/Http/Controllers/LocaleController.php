<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale()
    {
        app()->setLocale(request()->lang);
        session()->put('lang', request()->lang);
        return back();
    }
}
