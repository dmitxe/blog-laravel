@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('page', $page))
@section('title', $page->title)
@if (!empty($page->meta_description))
    @section('description', $page->meta_description)
@endif
@if (!empty($page->meta_keywords))
    @section('keywords', $page->meta_keywords)
@endif

@section('content')
    <h1>{{ $page->title }}</h1>
    <img src="{{ Voyager::image( $page->image ) }}" style="width:100%">
    <p>{!! $page->body !!}</p>
@endsection