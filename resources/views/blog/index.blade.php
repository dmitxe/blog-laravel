@extends('layout')

@section('title', 'Блог')

@section('breadcrumbs', Breadcrumbs::render('blog'))

@section('content')

     @foreach ($models as $model)

        @include('blog._view', ['model' => $model])

    @endforeach

    {{ $models->links() }}


@endsection
