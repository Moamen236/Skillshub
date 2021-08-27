<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set($lang, Request $request)
    {
        $accepted_lang = ['ar', 'en'];
        if (!in_array($lang, $accepted_lang)) {
            $lang = 'en';
        }
        $request->session()->put('lang', $lang);

        return back();
    }
}