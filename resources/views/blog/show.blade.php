@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('post', $article))
@section('title')
    {{ $article->title }}
@endsection
@section('content')

    <h2>{{ $article->title }}</h2>

    <?php $data = new Jenssegers\Date\Date($article->created_at);?>
    <p><i class="fa fa-calendar"></i> {{  $data->format('l, j F Y H:i:s') }}, написал <i class="fa fa-user"></i> <a href="#">{{ $article->authorId()->first()->name }}</a></p>

    <p>{!! nl2br($article->excerpt) !!} </p>

    <p>{!! $article->body !!}</p>

    @if ($article->tags)
        @foreach ($article->tags as $tag)
            <a href="{{ route('blog.tag', ['slug'=> $tag->slug]) }}"><span class="badge badge-info">{{ $tag->title }}</span></a>
        @endforeach
    @endif
    @if ($article->category)
    <a href="{{ route('blog.category', ['slug'=> $article->category->slug]) }}"><span class="badge badge-success">{{ $article->category->name }}</span></a>
    @endif

    <div>&nbsp;&nbsp;</div>
    <h4>Поделиться статьей с друзьями: </h4>
    <script type="text/javascript">(function() {
            if (window.pluso)if (typeof window.pluso.start == "function") return;
            if (window.ifpluso==undefined) { window.ifpluso = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
            }})();</script>
    <div class="pluso" data-background="#ebebeb" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>

    <div>&nbsp;&nbsp;</div>
    @widget('AdsWidget', ['position' => 'bottom'])

    <div>
        <h3>Комментарии к статье</h3>
        @widget('DisqusWidget', ['page_id' => route('blog.show', ['slug'=> $article->slug], false)])
    </div>

@endsection
