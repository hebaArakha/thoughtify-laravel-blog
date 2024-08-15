<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cacheDuration = 5;
        $articles = Cache::remember('AllArticles', $cacheDuration, function () {
            return Article::select('articles.id', 'articles.title', 'articles.created_at', 'articles.thumbnail_url', 'users.name as author_name',)
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
                ->paginate(15);
        });
        return $this->httpSuccess([
            'data' => ArticleResource::collection($articles),
            'total' => $articles->total(),
            'current_page' => $articles->currentPage(),
            'last_page' => $articles->lastPage(),
            'per_page' => $articles->perPage(),
            'next_page_url' => $articles->nextPageUrl(),
            'prev_page_url' => $articles->previousPageUrl(),
            'message' => 'Articles retrieved successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $article->author_id = auth()->id();
        $article->created_at = now();
        $article->updated_at = now();
        $article->save();
        return $this->httpSuccess([
            'message' => 'Article created successfully',
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->with(['comment.author', 'author'])->first();
        if (!$article) {
            return $this->httpFaliure('', 'Article not found', 404);
        }
        return $this->httpSuccess([
            'message' => 'article retrieved successfully',
            // 'data' => $article
            'data' => new ArticleResource($article)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $article = Article::find($id);
        if (!$article) {
            return $this->httpFaliure('', 'Article not found', 404);
        }
        if ($article->author_id !== auth()->id()) {
            return $this->httpFaliure('', 'Unauthorized to update this article', 403);
        }
        $request->validate([
            'title' => 'required|unique:articles,title,' . $id . '|min:10|max:100',
            'content' => 'required|min:50',
            'thumbnail_url' => 'nullable|url',
        ]);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->thumbnail_url = $request->thumbnail_url ?? 'https://musee-possen.lu/wp-content/uploads/2020/08/placeholder.png';;
        $article->author_id = auth()->id();
        $article->updated_at = now();
        $article->save();
        return $this->httpSuccess([
            'message' => 'article updated successfully',
            'data' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
