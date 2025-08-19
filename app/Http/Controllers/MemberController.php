<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Blog;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                    'profile_picture' => $member->profile_picture
                        ? Storage::disk('ftp')->url($member->profile_picture)
                        : asset('default-profile.png'),
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

        // Foto profil
        $member->profile_picture_url = $member->profile_picture
            ? Storage::disk('ftp')->url($member->profile_picture)
            : asset('images/default-profile.png');

        // Blogs
        $blogs = Blog::where('id_member', $member->id)
            ->latest('created_at')
            ->get()
            ->map(function ($blog) {
                $blog->thumbnail_url = $blog->thumbnail
                    ? Storage::disk('ftp')->url($blog->thumbnail)
                    : asset('/bg-blog.png');
                return $blog;
            });

        // Projects
        $projects = Project::where('id_member', $member->id)
            ->orWhereHas('collaborator', function ($query) use ($member) {
                $query->where('id_member', $member->id);
            })
            ->latest('created_at')
            ->get()
            ->map(function ($project) {
                $project->thumbnail_url = $project->thumbnail
                    ? Storage::disk('ftp')->url($project->thumbnail)
                    : asset('/bg-project.png');
                return $project;
            });

        // Contacts
        $contacts = $member->memberContact->map(function ($contact) {
            $contact->icon_url = $contact->icon
                ? Storage::disk('ftp')->url($contact->icon)
                : asset('images/default-contact.png');
            return $contact;
        });

        // Skills
        $skills = $member->memberSkill->map(function ($skill) {
            $skill->icon_url = $skill->icon
                ? Storage::disk('ftp')->url($skill->icon)
                : asset('images/default-skill.png');
            return $skill;
        });

        // Pagination Blog
        $blogPerPage = 6;
        $currentPageBlog = request()->get('blog_page', 1);
        $blogPaged = $blogs->forPage($currentPageBlog, $blogPerPage);
        $totalBlogPages = ceil($blogs->count() / $blogPerPage);

        // Pagination Project
        $projectPerPage = 6;
        $currentPageProject = request()->get('project_page', 1);
        $projectPaged = $projects->forPage($currentPageProject, $projectPerPage);
        $totalProjectPages = ceil($projects->count() / $projectPerPage);

        return view('members_page.show', [
            'member'            => $member,
            'contacts'          => $contacts ?? [],
            'skills'            => $skills ?? [],
            'blogs'             => $blogPaged,
            'totalBlogPages'    => $totalBlogPages,
            'currentBlogPage'   => $currentPageBlog,
            'projects'          => $projectPaged,
            'totalProjectPages' => $totalProjectPages,
            'currentProjectPage'=> $currentPageProject,
        ]);
    }
}