<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Blog;
use App\Models\Project;

class LandingController extends Controller
{
    public function index()
    {
        // Hitung jumlah member, blog, project
        $membersCount = Member::count();
        $blogsCount = Blog::where('is_published', true)->count();
        $projectsCount = Project::where('is_published', true)->count();

        // Ambil 4 blog terbaru untuk thumbnail
        $latestBlogs = Blog::where('is_published', true)->latest()->take(4)->get();

        // Ambil 3 project terbaru untuk thumbnail
        $latestProjects = Project::where('is_published', true)->latest()->take(3)->get();

        return view('landing_page.index', compact(
            'membersCount',
            'blogsCount',
            'projectsCount',
            'latestBlogs',
            'latestProjects'
        ));
    }
}
