<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs_page.index');
    }

    public function show()
    {
        return view('blogs_page.show');
    }
}
