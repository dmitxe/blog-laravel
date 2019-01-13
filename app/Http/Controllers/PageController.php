<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Page;

class PageController extends BaseController
{
    /**
     * Show page.
     *
     * @param  string  $slug
     * @return Response
     */
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('page', ['page' => $page]);
    }
}
