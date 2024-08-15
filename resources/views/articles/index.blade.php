@extends('layouts.layout')
@section('content')
    <div class="container">
        <a href=" {{ route('articles.create') }} ">
            <h3 class="text-success text-center add-thought m-4 bg-dark bg-opacity-10 rounded mx-auto">
                <i class="fa-solid fa-plus"></i>
            </h3>
        </a>
        <section id="gallery" class="mt-4">
            <div class="container">
                <div class="row">

                    @foreach ($articles as $article)
                        <div class="col-lg-3 mb-4 ">
                            <div class="card h-100">
                                <img src="{{ $article->thumbnail_url }}" alt="" class="card-img-top" height="200px">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $article->title }}</h5>
                                    <p class="card-text text-muted mb-1 mt-4"><i
                                            class="fa-regular fa-clock text-success me-2"></i>
                                        {{ $article->created_at }}</p>
                                    <p class="card-text text-muted my-1"><i class="fa-solid fa-at text-success me-2"></i>
                                        {{ $article->author_name }}</p>
                                    <p class="text-muted mt-1 mb-4"> <i class="fa-regular fa-comment text-success me-2"></i>
                                        {{ $article->comments_count }}
                                    </p>
                                    <a href="{{ route('articles.show', ['id' => $article->id]) }}"
                                        class="btn btn-outline-success btn-sm ">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


        </section>
    </div>

    <div class="container text-success">
        {{ $articles->links() }}
    </div>
@endsection
