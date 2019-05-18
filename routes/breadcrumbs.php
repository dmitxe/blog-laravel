<?php

// Home
Breadcrumbs::for('home', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
    $breadcrumbs->push('Главная', route('home'));
});

// Home > Welcome
Breadcrumbs::for('welcome', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Welcome', route('welcome'));
});

// Home > Contact
Breadcrumbs::for('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Форма обратной связи', route('contacts'));
});

// Home > Blog
Breadcrumbs::for('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Блог', route('blog.index'));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('blog.show', $post->slug));
});

// Home > Blog > Archive
Breadcrumbs::for('archive', function ($breadcrumbs, $title, $year, $month) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($title, route('blog.archive', ['year' => $year, 'month' => $month]));
});

// Home > Blog > Category
Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parentId) {
        $trail->parent('category', $category->parentId);
    } else {
        $trail->parent('home');
    }
    $trail->push($category->name, route('blog.category', $category->slug));
});

// Home > Blog > Tag
Breadcrumbs::for('tag', function ($breadcrumbs, $tag) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Статьи с тэгом '.$tag->title, route('blog.tag', ['slug' => $tag->slug]));
});

// Home >  [Page]
Breadcrumbs::for('page', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page->title, route('page', $page->slug));
});

// Home > News
Breadcrumbs::for('news-list', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Новости', route('news.index'));
});

// Home > News -> [News]
Breadcrumbs::for('news', function ($breadcrumbs, $news) {
    $breadcrumbs->parent('news-list');
    $breadcrumbs->push($news->title, route('news.show', $news->slug));
});

