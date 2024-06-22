<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('author', 'comment')->orderBy('created_at' , 'desc')->paginate(12);
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
        $article = Article::where('id', $id)->with(['comment.author', 'author'])->first();
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

    /**
     * Update the specified resource in storage.
     */
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

        // $article->user_id = Auth::id(); // Assuming the author is the currently authenticated user
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
