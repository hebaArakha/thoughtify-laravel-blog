<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::select('articles.id', 'articles.title', 'articles.created_at', 'articles.thumbnail_url', 'users.name as author_name',)
            ->join('users', 'articles.author_id', '=', 'users.id')
            ->withCount('comment')
            ->orderBy('articles.created_at', 'desc')
            ->groupBy(
                'articles.id',
                'articles.title',
                'articles.created_at',
                'articles.thumbnail_url',
                'users.name'
            )
            ->paginate(12);
        return view('articles.index', [
            'articles' => $articles
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => '|required|unique:articles|min:10|max:100',
            'content' => 'required|min:50',
            'thumbnail_url' => 'nullable|url',
            'author_id' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->thumbnail_url = $request->thumbnail_url ?? 'https://musee-possen.lu/wp-content/uploads/2020/08/placeholder.png';

        $article->author_id = $request->author_id;
        $article->created_at = now();
        $article->updated_at = now();

        // $article->user_id = Auth::id(); // Assuming the author is the currently authenticated user
        $article->save();
        return redirect()->route('articles.show', ['id' => $article->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->with(['comment.author','author'])->first();
        return view(
            'articles.show',
            ['article' => $article]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:articles,title,' . $id . '|min:10|max:100',
            'content' => 'required|min:50',
            'thumbnail_url' => 'nullable|url',
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->thumbnail_url = $request->thumbnail_url;
        $article->author_id = $request->author_id;
        $article->updated_at = now();
        $article->save();
        return redirect()->route('articles.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::find($id)->delete();
        return redirect()->route('articles.index');
    }
}
