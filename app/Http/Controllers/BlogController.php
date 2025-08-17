<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class BlogController extends Controller
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

        $query = Blog::with(['category', 'tags'])
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

        $blogs = $query->paginate(6)->appends($request->all());

        $cards = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'slug' => $blog->slug,
                'title' => $blog->title,
                'category' => $blog->category ? $blog->category->name : 'Uncategorized',
                'tags' => $blog->tags->pluck('name')->implode(', '),
                'modified' => $blog->created_at,
                'thumbnail' => $blog->thumbnail 
                    ? asset('storage/' . $blog->thumbnail) 
                    : asset('bg-blog.png'),
            ];
        });

        // Ambil kategori & tag yang dipakai blog published saja
        $categories = Category::whereHas('blog', function ($q) {
            $q->where('is_published', true);
        })->orderBy('name')->get();

        $tags = Tag::whereHas('blog', function ($q) {
            $q->where('is_published', true);
        })->orderBy('name')->get();

        // Ambil nama yang dipilih untuk summary di tombol
        $selectedCategoryNames = $categories->whereIn('slug', $filterCategorySlug)->pluck('name')->toArray();
        $selectedTagNames = $tags->whereIn('slug', $filterTagSlug)->pluck('name')->toArray();

        return view('blogs_page.index', [
            'blogs' => $blogs,
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
       // Ambil blog berdasarkan slug + relasi category, tags, dan member
        $blog = Blog::with(['category', 'tags', 'member'])
            ->where('slug', $slug)
            ->firstOrFail();

        $card = [
            'id'        => $blog->id,
            'slug'      => $blog->slug,
            'title'     => $blog->title,
            // Ambil writer dari relasi member (pastikan relasi 'member' ada di model Blog)
            'writer'    => $blog->member->name ?? 'Unknown',
            'category'  => $blog->category->name ?? 'No category',
            'tags'      => $blog->tags->pluck('name')->implode(', '),
            // Map path image ke storage
            'image'     => $blog->image ? asset('storage/'.$blog->image) : '/Chat 1.png',
            'thumbnail' => $blog->thumbnail ? asset('storage/'.$blog->thumbnail) : '',
            'modified'  => $blog->updated_at,
            'content'   => $blog->content ?? '',
        ];

        return view('blogs_page.show', compact('card'));
    }

}