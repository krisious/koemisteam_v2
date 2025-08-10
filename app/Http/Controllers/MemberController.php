<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Blog;
use App\Models\Project;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')
            ->select('id', 'id_user', 'slug', 'profile_picture', 'bio')
            ->get()
            ->map(function ($member) {
                return [
                    'name' => $member->user->name ?? 'Unknown', // dari tabel user
                    'profile_picture' => $member->profile_picture,  
                    'slug' => $member->slug,
                    'bio' => $member->bio,
                ];
            });

        return view('members_page.index', compact('members'));
        // Bagi menjadi grup per 5 member
        // $chunks = array_chunk($members, 5);
    }
        

    public function show($slug)
    {
        // Ambil data member berdasarkan slug, beserta relasi
        $member = Member::where('slug', $slug)
            ->with([
                'memberContact', // relasi ke member_contacts
                'memberSkill',   // relasi ke member_skills
            ])
            ->firstOrFail();

        // Ambil blog yang dikerjakan oleh member ini
        $blogs = Blog::where('id_member', $member->id)
            ->latest('created_at')
            ->get();

        // Ambil project yang dikerjakan oleh member ini
        $projects = Project::where('id_member', $member->id) // Owner project
            ->orWhereHas('collaborator', function ($query) use ($member) {
                $query->where('id_member', $member->id); // Sebagai collaborator
            })
            ->latest('created_at')
            ->get();

        // Pagination manual untuk blog
        $blogPerPage = 6;
        $currentPageBlog = request()->get('blog_page', 1);
        $blogPaged = $blogs->forPage($currentPageBlog, $blogPerPage);
        $totalBlogPages = ceil($blogs->count() / $blogPerPage);

        // Pagination manual untuk project
        $projectPerPage = 6;
        $currentPageProject = request()->get('project_page', 1);
        $projectPaged = $projects->forPage($currentPageProject, $projectPerPage);
        $totalProjectPages = ceil($projects->count() / $projectPerPage);

        // Kirim data ke view
        return view('members_page.show', [
            'member'            => $member,
            'contacts'          => $member->memberContact ?? [],
            'skills'            => $member->memberSkill ?? [],
            'blogs'             => $blogPaged,
            'totalBlogPages'    => $totalBlogPages,
            'currentBlogPage'   => $currentPageBlog,
            'projects'          => $projectPaged,
            'totalProjectPages' => $totalProjectPages,
            'currentProjectPage'=> $currentPageProject,
        ]);
    }
}