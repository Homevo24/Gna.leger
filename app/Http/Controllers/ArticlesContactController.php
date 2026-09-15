<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticlesContactController extends Controller
{
    public function index(): View
    {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('articles-contact.index', [
            'articles' => $articles,
        ]);
    }
}
