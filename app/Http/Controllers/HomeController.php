<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use TCG\Voyager\Models\Post;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $models = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('home', ['models' => $models]);
      //  $models = Post::all();
      //  return view('home', compact('models'));
    }
}
