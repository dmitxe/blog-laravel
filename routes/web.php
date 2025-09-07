<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
//use Voyager;

// Web Routes
Route::get('/welcome', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Статическая страница по слагу
Route::get('page/{slug}', [PageController::class, 'show']);

// Маршруты аутентификации
Auth::routes([
    'register' => false, // Отключаем регистрацию
]);

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Блог
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/blog/archive/{year}/{month}', [BlogController::class, 'archive'])->name('blog.archive');
Route::get('/blog/{slug}.html', [BlogController::class, 'show'])->name('blog.show');

// Контакты
Route::get('/contacts', [ContactController::class, 'show'])->name('contacts');
Route::post('/contact', [ContactController::class, 'mailToAdmin']);

// Статичные страницы
Route::get('/{page}.html', [PageController::class, 'index'])->name('page');

// Новости
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}.html', [NewsController::class, 'show'])->name('news.show');

// Sitemap
Route::get('sitemap', [SitemapController::class, 'index']); 
