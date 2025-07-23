<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('members_page.index');
    }

    public function show()
    {
        return view('members_page.show');
    }
}
