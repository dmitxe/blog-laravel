@extends('layout')

@section('title', 'Статьи с тэгом ' .$tag->title )

@section('breadcrumbs', Breadcrumbs::render('tag', $tag))

@section('content')

     @foreach ($models as $model)

        @include('blog._view', ['model' => $model])

    @endforeach

    {{ $models->links() }}


@endsection
