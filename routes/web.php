<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('page/{slug}', 'PageController@show');

Auth::routes([
    'register' => false, // Registration Routes...
]);

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/blog', 'BlogController@index')->name('blog.index');

Route::get('/blog/category/{slug}', 'BlogController@category')->name('blog.category');

Route::get('/blog/tag/{slug}', 'BlogController@tag')->name('blog.tag');

Route::get('/blog/archive/{year}/{month}', 'BlogController@archive')->name('blog.archive');

Route::get('/blog/{slug}.html', 'BlogController@show')->name('blog.show');

Route::get('/contacts', 'ContactController@show')->name('contacts');

Route::post('/contact',  'ContactController@mailToAdmin');

Route::get('/{page}.html', 'PageController@index')->name('page');

Route::get('/news', 'NewsController@index')->name('news.index');

Route::get('/news/{news}.html', 'NewsController@show')->name('news.show');

Route::get('sitemap', 'SitemapController@index');
