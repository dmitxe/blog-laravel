@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('news', $model))
@section('title')
    <?= $model->title ?>
@endsection

@section('content')
    <h1>{{ $model->title }}</h1>
    <?php $data = new Jenssegers\Date\Date($model->created_at);?>
    <p><b>{{  $data->format('l, j F Y H:i:s') }}</b></p>
    @if ($model->image)
        <img src="{{ Voyager::image( $model->image ) }}" style="width:100%">
    @endif
    <p>{!! $model->body !!}</p>
@endsection