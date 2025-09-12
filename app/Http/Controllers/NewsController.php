<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class NewsController extends BaseController
{
    /**
     * Show all news.
     *
     * @param  string  $slug
     * @return Response
     */
    public function index()
    {
        $models = News::orderBy('created_at', 'DESC')->paginate(10);
        return view('news.index', ['models' => $models]);
    }

    /**
     * Show news.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $model = News::where('slug', $slug)->firstOrFail();
        return view('news.show', ['model' => $model]);
    }
}
