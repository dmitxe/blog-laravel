<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
//use TCG\Voyager\Models\Post;

class BlogController extends BaseController
{
    // количество записей на странице
    public $item_count = 10;
    /**
     * Show the posts
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $models = Post::orderBy('created_at', 'DESC')->paginate($this->item_count);
        return view('blog.index', ['models' => $models]);
    }

    /**
     * Show the posts of category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category($slug)
    {
        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $models = Post::where('category_id', '=', $category->id)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->item_count);
        return view('blog.category', [
            'category' => $category,
            'models' => $models,
        ]);
    }

    /**
     * Show the posts of tag.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tag($slug)
    {
        $tag = Tag::where('slug', '=', $slug)->firstOrFail();
        $tag_id = $tag->id;
        $models = Post::whereHas('tags', function($q) use($tag_id) {
            $q->where('id', $tag_id);
        })->orderBy('created_at', 'DESC')->paginate($this->item_count);
        return view('blog.tag', [
            'models' => $models,
            'tag' => $tag
        ]);
    }

    /**
     * Show the posts of archive.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function archive($year, $month)
    {
        $models = Post::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->item_count);

        return view('blog.archive', [
            'models' => $models,
            'year' => $year,
            'month' => $month,
        ]);
    }

    /**
     * Show the post of slug.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $article = Post::where('slug', '=', $slug)->firstOrFail();
        return view('blog.show', ['article' => $article]);
    }
}
