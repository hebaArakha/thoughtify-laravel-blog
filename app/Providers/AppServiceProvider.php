<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // \Debugbar::enable();

        // $recentArticles = 

        // View::share(
        //     'recentArticles',
        //     Article::select('id', 'title', 'created_at', 'author_id', 'thumbnail_url')->orderBy('created_at', 'desc')->take(4)->get()
        // );
        
    }
}
