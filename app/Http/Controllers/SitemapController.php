<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jenssegers\Date\Date;
use Laravelium\Sitemap\Sitemap;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index() {

        $sitemap = App::make("sitemap");

        $sitemap->add(URL::to('/'), Date::now(), '1.0', 'monthly');


        $pages = DB::table('pages')->orderBy('created_at', 'desc')->get();

        foreach ($pages as $page)
        {
            $sitemap->add(route('page', ['slug' =>$page->slug]), $page->updated_at, '0.5', 'yearly');
        }

        $articles = DB::table('posts')->orderBy('created_at', 'desc')->get();

        foreach ($articles as $article)
        {
            $sitemap->add(route('blog.show', ['slug' =>$article->slug]), $article->updated_at, '0.5', 'yearly');
        }

        $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();

        foreach ($categories as $category)
        {
            $sitemap->add(route('blog.category', ['slug' =>$category->slug]), $category->updated_at, '0.5', 'yearly');
        }

        $tags = DB::table('categories')->orderBy('created_at', 'desc')->get();

        foreach ($tags as $tag)
        {
            $sitemap->add(route('blog.tag', ['slug' =>$tag->slug]), $tag->updated_at, '0.5', 'yearly');
        }

        $sitemap->store('xml', 'sitemap');

    }
}