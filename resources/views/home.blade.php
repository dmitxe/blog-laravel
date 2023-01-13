@extends('layout')
@section('title', 'Блог веб-программиста')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

    <h1>Добро пожаловать!</h1>
    <p>Меня зовут Дмитрий. Я веб-программист, занимаюсь созданием сайтов.
        На этом блоге находятся мои заметки по программированию. Многие идеи
        взяты у других авторов, часть текста - первод с английского, что-то придумал сам).
    </p>

    <?php //var_dump($models) ?>
    @foreach ($models as $model)

        @include('blog._view', ['model' => $model])

    @endforeach

    {{ $models->links() }}


@endsection
