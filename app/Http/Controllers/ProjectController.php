<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects_page.index');
    }

    public function show()
    {
        return view('projects_page.show');
    }
}
