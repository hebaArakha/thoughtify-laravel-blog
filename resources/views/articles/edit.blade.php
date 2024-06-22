@extends('layouts.layout')
@section('content')
    <div class="container my-3 col-10 col-md-8 col-lg-6 m-auto m-auto ">
        <h4 class="text-success text-center">Add your new thought...</h4>
        <hr class="text-success">
        <form action="{{ route('articles.update', ['id' => $article->id]) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group my-2">
                <label for="title" class="form-label">Title:</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ $article->title }}">
            </div>
            @error('title')
                <span class="text-danger">* {{ $message }}</span>
            @enderror

            <div class="form-group my-2">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="content" cols="30" rows="8">{{ $article->content }}</textarea>
            </div>
            @error('content')
                <span class="text-danger">* {{ $message }}</span>
            @enderror

            <div class="form-group my-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input class="form-control" type="text" id="image" name="thumbnail_url"
                    value="{{ $article->thumbnail_url }}">
            </div>
            @error('thumbnail_url')
                <span class="text-danger">* {{ $message }}</span>
            @enderror

            <input class="form-control" type="hidden" name="article_id" value="{{ $article->id }}">
            <input class="form-control" type="hidden" name="author_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-success row col-12 col-md-3 m-auto float-md-end">Update thought</button>
        </form>

    </div>
@endsection
