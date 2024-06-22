@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <!-- Post Section -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3 author-avatar " alt="Author Avatar">
                    <div>
                        <h5 class="card-title text-success">{{ $article->author->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Posted
                            {{ Carbon\Carbon::parse($article->created_at)->diffForHumans() }}

                        </h6>
                    </div>

                    @auth
                        @if (auth()->user()->id == $article->author->id)
                            <i class="fa-solid fa-ellipsis-vertical text-success fs-3 menu" onclick="dropMenu()"></i>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="{{ route('articles.edit', ['id' => $article->id]) }}" class="text-center">Edit
                                    Article</a>
                                <form action="{{ route('articles.destroy', ['id' => $article->id]) }}" method="post"
                                    class="p-1">
                                    @csrf
                                    @method('delete')
                                    {{-- <button type="submit" data-disabled-submit class="btn"                            data-confirm="Are you sure you want to delete this article?">Delete Article</button> --}}
                                    <button type="submit" class="btn w-100"
                                        onclick=" return confirm('Are you sure you want to delete this article? ')">Delete
                                        Article</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="mx-md-5 px-3 justify-contebt-center">
                    <h2 class="mt-3 col-12">{{ $article->title }}</h2>
                    <div class="d-flex row ">
                        <p class="card-text col-12 col-lg-9">{{ $article->content }}</p>
                        <img class="img-fluid col-12 col-lg-3 " src="{{ $article->thumbnail_url }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="card">
            <div class="card-header bg-success-subtle">
                <h3 class="bg-success-subtle">Comments</h3>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($article->comment as $comment)
                    <!-- Comment 1 -->
                    <li class="list-group-item">
                        <div class="comment-header">
                            <img src="https://via.placeholder.com/40" class="comment-avatar" alt="Commenter Avatar">
                            <div>
                                <h6 class="mb-0 text-success">{{ $comment->author->name }}</h6>
                                <p class="mb-1" style="overflow-wrap: break-word;">
                                    {{ $comment->content }}</p>
                            </div>
                        </div>
                        <div class="comment-body">
                            <small
                                class="text-muted">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                        </div>
                    </li>
                    <!-- Comment 2 -->
                @endforeach

            </ul>
            <div class="card-footer">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <div class="d-flex align-items-start">
                        <img src="https://via.placeholder.com/40" class="comment-avatar" alt="Your Avatar">
                        <textarea class="form-control ms-3" id="commentInput" rows="1"
                            @auth
placeholder="Write a comment..." name="content" @endauth
                            @guest disabled
                            placeholder="Login first to write a comment..." name="content"
                            style="cursor: not-allowed" @endguest></textarea>
                        <input type="hidden" name="author_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                    </div>
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn"><i
                                class="fa-solid fa-arrow-up-from-bracket text-success"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
