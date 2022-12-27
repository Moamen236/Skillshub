<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Cat::all();
        return view('web.home.index', compact('categories'));
    }
}