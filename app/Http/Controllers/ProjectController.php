<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Data dummy manual
        $cards = [
            ['id' => 0, 'title' => 'SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)', 'category' => 'Education', 'tags' => 'SPK, TOPSIS', 'modified' => '2025-08-01'],
            ['id' => 1, 'title' => 'Judul Artikel 2', 'category' => 'Teknologi', 'tags' => 'AI, Machine Learning', 'modified' => '2025-07-28'],
            ['id' => 2, 'title' => 'Judul Artikel 3', 'category' => 'Bisnis', 'tags' => 'Marketing, Sales', 'modified' => '2025-07-20'],
            ['id' => 3, 'title' => 'Judul Artikel 4', 'category' => 'Kesehatan', 'tags' => 'Wellness, Nutrition', 'modified' => '2025-07-18'],
            ['id' => 4, 'title' => 'Judul Artikel 5', 'category' => 'Seni', 'tags' => 'Design, Painting', 'modified' => '2025-07-15'],
            ['id' => 5, 'title' => 'Judul Artikel 6', 'category' => 'Olahraga', 'tags' => 'Football, Training', 'modified' => '2025-07-12'],
            ['id' => 6, 'title' => 'Judul Artikel 7', 'category' => 'Musik', 'tags' => 'Jazz, Rock', 'modified' => '2025-07-10'],
            ['id' => 7, 'title' => 'Judul Artikel 8', 'category' => 'Travel', 'tags' => 'Adventure, Tips', 'modified' => '2025-07-05'],
            ['id' => 8, 'title' => 'Judul Artikel 9', 'category' => 'Fashion', 'tags' => 'Style, Trends, Sales', 'modified' => '2025-07-01'],
        ];

        // Ambil input dari request
        $search = strtolower($request->input('search', ''));
        $filterModified = $request->input('filter_modified', '');
        $filterCategory = $request->input('filter_category', '');
        $filterTag = $request->input('filter_tag', '');

        // Filter berdasarkan search (judul)
        if ($search) {
            $cards = array_filter($cards, function($card) use ($search) {
                return strpos(strtolower($card['title']), $search) !== false;
            });
        }

        // Filter berdasarkan Modified
        if ($filterModified == 'latest') {
            usort($cards, fn($a, $b) => strcmp($b['modified'], $a['modified']));
        } elseif ($filterModified == 'oldest') {
            usort($cards, fn($a, $b) => strcmp($a['modified'], $b['modified']));
        }

        // Filter berdasarkan Category
        if ($filterCategory) {
            $cards = array_filter($cards, fn($card) => strtolower($card['category']) === strtolower($filterCategory));
        }

        // Filter berdasarkan Tag
        if ($filterTag) {
            $cards = array_filter($cards, fn($card) => stripos($card['tags'], $filterTag) !== false);
        }

        // Reset index setelah filter
        $cards = array_values($cards);

        // Pagination
        $perPage = 8;
        $currentPage = $request->get('page', 1);
        $total = count($cards);
        $totalPages = ceil($total / $perPage);
        $start = ($currentPage - 1) * $perPage;
        $cardsToShow = array_slice($cards, $start, $perPage);

        return view('projects_page.index', [
            'cards' => $cardsToShow,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'startIndex' => $start,
            'search' => $search,
            'filterModified' => $filterModified,
            'filterCategory' => $filterCategory,
            'filterTag' => $filterTag,
        ]);
    }

    public function show($id)
    {
        $cards = [
            ['id' => 0, 'title' => 'SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)', 'category' => 'Education', 'tags' => 'SPK, TOPSIS', 'modified' => '2025-08-01', 'collaborator' => 'Agung Krissanto', 'image' => '/bg-blog.png', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam vel porttitor imperdiet ut a aliquam dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam vel porttitor imperdiet ut a aliquam dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam vel porttitor.', 'project_link' => 'https://github.com/krisious/koemisteam_v2, https://www.figma.com/design/8lhcrChmxRduSNULP4qctK/Koemis-Team-Prototype?node-id=27-143&t=NdHSzPeREZEH3nDI-1'],
            ['id' => 1, 'title' => 'Judul Artikel 2', 'category' => 'Teknologi', 'tags' => 'AI, Machine Learning', 'modified' => '2025-07-28', 'collaborator' => 'Dwi Krisdiyanto', 'image' => '/Chat 2.png', 'content' => 'Isi konten artikel 2...', 'project_link' => 'https://github.com/krisious, https://github.com/AgungKriss, https://tailwindcss.com/docs/background-color#applying-on-hover'],
            // ... tambahkan data lain sesuai kebutuhan
        ];

        $card = collect($cards)->firstWhere('id', $id);

        if (!$card) {
            abort(404);
        }

        return view('projects_page.show', compact('card'));
    }
}
 