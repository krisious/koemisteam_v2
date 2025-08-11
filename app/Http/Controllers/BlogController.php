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
        $filterCategory = $request->get('filter_category', []); // array
        $filterTag = $request->get('filter_tag', []); // array
        $filterModified = $request->get('filter_modified');

        // Query awal: hanya blog yang dipublish
        $query = Blog::with(['category', 'tags'])
            ->where('is_published', true);

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter kategori (multiple)
        if (!empty($filterCategory)) {
            $query->whereIn('id_category', $filterCategory);
        }

        // Filter tag (multiple)
        if (!empty($filterTag)) {
            $query->whereHas('tags', function ($q) use ($filterTag) {
                $q->whereIn('tags.id', $filterTag);
            });
        }

        // Sort by modified date
        if ($filterModified === 'latest') {
            $query->orderBy('updated_at', 'desc');
        } elseif ($filterModified === 'oldest') {
            $query->orderBy('updated_at', 'asc');
        }

        // Ambil data blog paginated
        $blogs = $query->paginate(6)->appends($request->all());

        // Data untuk card view
        $cards = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'category' => $blog->category ? $blog->category->name : 'Uncategorized',
                'tags' => $blog->tags->pluck('name')->implode(', '),
                'modified' => $blog->created_at,
                'thumbnail' => $blog->thumbnail 
                    ? asset('storage/' . $blog->thumbnail) 
                    : asset('bg-blog.png'), // fallback
            ];
        });

        // Daftar kategori & tag untuk filter
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('blogs_page.index', [
            'blogs' => $blogs,
            'cards' => $cards,
            'search' => $search,
            'filterCategory' => $filterCategory,
            'filterTag' => $filterTag,
            'filterModified' => $filterModified,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function show($id)
    {
        $cards = [
            ['id' => 0, 'title' => 'SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)', 'category' => 'Education', 'tags' => 'SPK, TOPSIS', 'modified' => '2025-08-01', 'writer' => 'John Doe', 'image' => '/Chat 1.png', 'content' => 'Berawal dari perkumpulan tiga remaja...'],
            ['id' => 1, 'title' => 'Judul Artikel 2', 'category' => 'Teknologi', 'tags' => 'AI, Machine Learning', 'modified' => '2025-07-28', 'writer' => 'Jane Smith', 'image' => '/Chat 2.png', 'content' => 'Isi konten artikel 2...'],
            // ... tambahkan data lain sesuai kebutuhan
        ];

        $card = collect($cards)->firstWhere('id', $id);

        if (!$card) {
            abort(404);
        }

        return view('blogs_page.show', compact('card'));
    }
}