@extends('layout')

<?php
$data = new Jenssegers\Date\Date('01-'.$month.'-'.$year);
$title = 'Архив статей за ' . $data->format('F Y')
?>
@section('title', $title )

@section('breadcrumbs', Breadcrumbs::render('archive', $title, $year, $month))

@section('content')

     @foreach ($models as $model)

        @include('blog._view', ['model' => $model])

    @endforeach

    {{ $models->links() }}


@endsection
