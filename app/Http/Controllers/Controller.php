<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Article;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {

        $recents = Article::orderBy('created_at', 'desc')->take(4)->get();
        $populars = Article::withCount('comment')
            ->orderBy('comment_count', 'desc')
            ->take(4)
            ->get();
        return view('home.index', [
            'recents' => $recents,
            'populars' => $populars
        ]);
    }
}
