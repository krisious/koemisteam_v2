<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filterCategorySlug = (array) $request->get('filter_category', []);
        $filterTagSlug = (array) $request->get('filter_tag', []);
        $filterModified = $request->get('filter_modified');

        // Convert slug ke ID untuk query
        $filterCategory = Category::whereIn('slug', $filterCategorySlug)->pluck('id')->toArray();
        $filterTag = Tag::whereIn('slug', $filterTagSlug)->pluck('id')->toArray();

        $query = Project::with(['category', 'tags'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (!empty($filterCategory)) {
            $query->whereIn('id_category', $filterCategory);
        }

        if (!empty($filterTag)) {
            $query->whereHas('tags', function ($q) use ($filterTag) {
                $q->whereIn('tags.id', $filterTag);
            });
        }

        if ($filterModified === 'latest') {
            $query->orderBy('updated_at', 'desc');
        } elseif ($filterModified === 'oldest') {
            $query->orderBy('updated_at', 'asc');
        }

        $projects = $query->paginate(6)->appends($request->all());

        $cards = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'slug' => $project->slug,
                'title' => $project->title,
                'category' => $project->category ? $project->category->name : 'Uncategorized',
                'tags' => $project->tags->pluck('name')->implode(', '),
                'modified' => $project->created_at,
                'thumbnail' => $project->thumbnail
                    ? asset('storage/' . $project->thumbnail)
                    : asset('bg-project.png'),
            ];
        });

        // Ambil kategori & tag yang dipakai project published saja
        $categories = Category::whereHas('project', function ($q) {
            $q->where('is_published', true);
        })->orderBy('name')->get();

        $tags = Tag::whereHas('project', function ($q) {
            $q->where('is_published', true);
        })->orderBy('name')->get();

        // Ambil nama yang dipilih untuk summary di tombol
        $selectedCategoryNames = $categories->whereIn('slug', $filterCategorySlug)->pluck('name')->toArray();
        $selectedTagNames = $tags->whereIn('slug', $filterTagSlug)->pluck('name')->toArray();

        return view('projects_page.index', [
            'projects' => $projects,
            'cards' => $cards,
            'search' => $search,
            'filterModified' => $filterModified,
            'categories' => $categories,
            'tags' => $tags,
            'selectedCategories' => $filterCategorySlug, // slug
            'selectedTags' => $filterTagSlug, // slug
            'selectedCategoryNames' => $selectedCategoryNames,
            'selectedTagNames' => $selectedTagNames,
        ]);   
    }

    public function show($slug)
    {
        // Ambil project berdasarkan slug + relasi category, tags, dan member
        $project = Project::with([
            'category',
            'tags',
            'member.user',
            'collaborator.user',
            'link'
        ])->where('slug', $slug)->firstOrFail();

        // Owner (satu)
        $owner = [];
        if ($project->member && $project->member->user) {
            $owner = [
                'name' => $project->member->user->name,
                'profile_picture' => $project->member->profile_picture 
                    ? asset('storage/' . $project->member->profile_picture)
                    : '/default-avatar.png',
                'slug' => $project->member->slug,
            ];
        }

        // Collaborators (banyak)
        $collaborators = $project->collaborator->map(function ($member) {
            return [
                'name' => $member->user?->name,
                'profile_picture' => $member->profile_picture 
                    ? asset('storage/' . $member->profile_picture)
                    : '/default-avatar.png',
                'slug' => $member->slug,
            ];
        })->filter()->values()->toArray();

        // Gabungkan owner + collaborators
        $allCollaborators = [];
        if (!empty($owner)) {
            $allCollaborators[] = $owner;
        }
        $allCollaborators = array_merge($allCollaborators, $collaborators);

        $links = $project->link->map(function ($link) {
            return [
                'url' => $link->pivot->url ?: '#',
                'name' => $link->name,
                'icon' => $link->icon,
            ];
        })->toArray();

        $card = [
            'id'            => $project->id,
            'slug'          => $project->slug,
            'title'         => $project->title,
            'collaborators' => $allCollaborators, // 👈 siap dipakai di Blade
            'category'      => $project->category->name ?? 'No category',
            'tags'          => $project->tags->pluck('name')->implode(', '),
            'link'          => $links,
            'image'         => $project->image ? asset('storage/'.$project->image) : '/Chat 1.png',
            'thumbnail'     => $project->thumbnail ? asset('storage/'.$project->thumbnail) : '',
            'modified'      => $project->updated_at,
            'content'       => $project->content ?? '',
        ];

        return view('projects_page.show', compact('card'));
    }
} 