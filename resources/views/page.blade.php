@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('page', $page))
@section('title')
    <?= $page->title ?>
@endsection

@section('content')
    <h1>{{ $page->title }}</h1>
    <img src="{{ Voyager::image( $page->image ) }}" style="width:100%">
    <p>{!! $page->body !!}</p>
@endsection