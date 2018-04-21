<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homepage()
    {
        return view('frontPages.homepage');
    }
    public function about()
    {
        return view('frontPages.about');
    }
    public function contact()
    {
        return view('frontPages.contact');
    }
}
