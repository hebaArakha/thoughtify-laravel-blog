<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


use App\Models\Article;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {

        $cacheDuration = 5 * 60; //cache for 5 minutes
        $recents = Cache::remember('recents', $cacheDuration, function () {
            return Article::select('id', 'title', 'created_at', 'author_id', 'thumbnail_url')->orderBy('created_at', 'desc')->take(4)->get();
        });
        $populars = Cache::remember('populars', $cacheDuration, function () {
            return Article::select('id', 'title', 'created_at', 'author_id', 'thumbnail_url')->withCount('comment')->orderBy('comment_count', 'desc')->take(4)->get();
        });

        return view('home.index', [
            'recents' => $recents,
            'populars' => $populars
        ]);
    }
}
