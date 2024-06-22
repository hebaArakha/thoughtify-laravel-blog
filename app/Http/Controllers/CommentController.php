<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'author_id' => 'required',
            'content' => 'required',
            'article_id' => 'required',
        ]);

        // Create a new article
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->author_id = $request->author_id;
        $comment->article_id = $request->article_id;
        $comment->created_at = now();
        $comment->updated_at = now();

        // $comment->user_id = Auth::id(); // Assuming the author is the currently authenticated user
        $comment->save();
        return redirect()->route('articles.show' , ['id' => $request->article_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
