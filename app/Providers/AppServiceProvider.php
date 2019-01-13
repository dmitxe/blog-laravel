<?php

namespace App\Providers;

use App\Observers\Post_tagObserver;
use App\Observers\PostObserver;
use App\Post_tag;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        Carbon::setLocale(config('app.locale'));

      //  Post::observe(PostObserver::class);
     //   Post_tag::observe(Post_tagObserver::class);
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return realpath(base_path() . '/web');
        });
    }
}
