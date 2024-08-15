<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


use App\Models\Article;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {

        $cacheDuration = 5; //cache for 5 minutes
        $recents = Cache::remember('recents', $cacheDuration, function () {
            return Article::select('articles.id', 'articles.title', 'articles.created_at', 'articles.thumbnail_url', 'users.name as author_name')
                ->join('users', 'articles.author_id', '=', 'users.id')
                ->withCount('comment')
                ->orderBy('articles.created_at', 'desc')
                ->take(4)
                ->get();
        });
        $populars = Cache::remember('populars', $cacheDuration, function () {
            return Article::select('articles.id', 'articles.title', 'articles.created_at', 'articles.thumbnail_url', 'users.name as author_name', DB::raw('COUNT(comments.id) as comments_count'))
                ->join('users', 'articles.author_id', '=', 'users.id')
                ->leftJoin('comments', 'articles.id', '=', 'comments.article_id')
                ->groupBy('articles.id', 'articles.title', 'articles.created_at', 'articles.thumbnail_url', 'users.name')
                ->orderBy('comments_count', 'desc')
                ->take(4)
                ->get();
        });

        return view('home.index', [
            'recents' => $recents,
            'populars' => $populars
        ]);
    }
}
