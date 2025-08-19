<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Blog;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function index()
    {
        // Hitung jumlah member, blog, project
        $membersCount = Member::count();
        $blogsCount = Blog::where('is_published', true)->count();
        $projectsCount = Project::where('is_published', true)->count();

        // Ambil 4 blog terbaru untuk thumbnail + url ftp
        $latestBlogs = Blog::where('is_published', true)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($blog) {
                $blog->thumbnail_url = $blog->thumbnail
                    ? Storage::disk('ftp')->url($blog->thumbnail)
                    : asset('/bg-blog.png');
                return $blog;
            });

        // Ambil 3 project terbaru untuk thumbnail + url ftp
        $latestProjects = Project::where('is_published', true)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($project) {
                $project->thumbnail_url = $project->thumbnail
                    ? Storage::disk('ftp')->url($project->thumbnail)
                    : asset('/bg-project.png');
                return $project;
            });

        return view('landing_page.index', compact(
            'membersCount',
            'blogsCount',
            'projectsCount',
            'latestBlogs',
            'latestProjects'
        ));
    }
}
