@extends('layouts.layout')
@section('content')
    <header class="pb-2 d-none d-sm-flex">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5  rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">A warm welcome!</h1>
                    <p class="fs-4">Welcome to Thoughtify, where ideas take flight and thoughts find their voice. Dive into
                        a realm where curiosity meets contemplation, and every scroll unveils a new perspective. Whether
                        you're exploring the depths of philosophy or unraveling the mysteries of the universe, our blog is
                        your gateway to insightful musings and thought-provoking discussions. Join us on a journey of
                        discovery, where each article sparks curiosity and ignites the imagination. Welcome to a space where
                        thoughts are transformed into ideas, and ideas inspire change.</p>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid px-0 py-3 px-lg-5 ">
        <h3 class="fw-bold text-center"><i class="fa-regular fa-clock text-success"></i> Most recent articles <i
                class="fa-regular fa-clock text-success"></i></h3>
        <hr class="text-success">

        <section id="gallery" class="mt-4">
            <div class="container">
                <div class="row">

                    @foreach ($recents as $recent)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 ">
                            <div class="card h-100">
                                <img src="{{ $recent->thumbnail_url }}" alt="" class="card-img-top" height="200px">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $recent->title }}</h5>
                                    <p class="card-text text-muted mb-1 mt-4"><i
                                            class="fa-regular fa-clock text-success me-2"></i>
                                        {{ $recent->created_at }}</p>
                                    <p class="card-text text-muted my-1"><i class="fa-solid fa-at text-success me-2"></i>
                                        {{ $recent->author_name }}</p>
                                    <p class="text-muted mt-1 mb-4"> <i class="fa-regular fa-comment text-success me-2"></i>
                                        {{ $recent->comment_count }}
                                    </p>
                                    <a href="{{ route('articles.show', ['id' => $recent->id]) }}"
                                        class="btn btn-outline-success btn-sm ">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h5 class="text-end"><a href="{{ route('articles.index') }}"
                        class="text-success text-end text-decoration-none">View all articles
                        &nbsp;<i class="fa-solid fa-arrow-right"></i></a></h5>
            </div>
        </section>
    </div>
    <div class="container-fluid px-0 py-3 px-lg-5 bg-dark bg-opacity-10">
        <h3 class="fw-bold text-center"><i class="fa-solid fa-fire text-success"></i> Most pupular articles <i
                class="fa-solid fa-fire text-success"></i></h3>
        <hr class="text-success">

        <section id="gallery" class="mt-4">
            <div class="container">
                <div class="row">

                    @foreach ($populars as $popular)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 ">
                            <div class="card h-100">
                                <img src="{{ $popular->thumbnail_url }}" alt="" class="card-img-top" height="200px">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $popular->title }}</h5>
                                    <p class="card-text text-muted mb-1 mt-4"><i
                                            class="fa-regular fa-clock text-success me-2"></i>
                                        {{ $popular->created_at }}</p>
                                    <p class="card-text text-muted my-1"><i class="fa-solid fa-at text-success me-2"></i>
                                        {{ $popular->author_name }}</p>
                                    <p class="text-muted mt-1 mb-4"> <i class="fa-regular fa-comment text-success me-2"></i>
                                        {{ $popular->comments_count }}
                                    </p>
                                    <a href="{{ route('articles.show', ['id' => $popular->id]) }}"
                                        class="btn btn-outline-success btn-sm ">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
