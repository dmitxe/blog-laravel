@extends('layout')

@section('title', 'Статьи в категории ' .$category->name )

@section('breadcrumbs', Breadcrumbs::render('category', $category))

@section('content')

     @foreach ($models as $model)

        @include('blog._view', ['model' => $model])

    @endforeach

    {{ $models->links() }}


@endsection
