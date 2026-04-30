<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Product::observe(ProductObserver::class);

        App::setLocale(session('app_locale', config('app.locale')));

        View::composer('*', function ($view) {
            $view->with('navCategories', Category::all());
        });

    }
}
