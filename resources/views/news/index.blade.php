@extends('layout')

@section('title', 'Блог')

@section('breadcrumbs', Breadcrumbs::render('news-list'))

@section('content')

     @foreach ($models as $model)

         <h2><a href="{{  route('news.show', ['slug' => $model->slug]) }}">{{ $model->title }}</a></h2>
         <?php $data = new Jenssegers\Date\Date($model->created_at);?>
         <p><b>{{  $data->format('l, j F Y H:i:s') }}</b></p>
         <p>{!! nl2br($model->excerpt) !!} </p>

    @endforeach

    {{ $models->links() }}


@endsection
