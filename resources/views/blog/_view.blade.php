    <h2><a href="{{  route('blog.show', ['slug' => $model->slug]) }}">{{ $model->title }}</a></h2>

    <?php $data = new Jenssegers\Date\Date($model->created_at);?>
    <p><i class="fa fa-calendar"></i> {{  $data->format('l, j F Y H:i:s') }}, написал <i class="fa fa-user"></i> <a href="#">{{ $model->authorId()->first()->name }}</a></p>

    <p>{!! nl2br($model->excerpt) !!} </p>

    <p><a href="{{  route('blog.show', ['slug' => $model->slug]) }}" class="btn btn-info pull-right">Читать дальше</a></p>

    @if ($model->tags)
        @foreach ($model->tags as $tag)
            <a href="{{ route('blog.tag', ['slug'=> $tag->slug]) }}"><span class="badge badge-info">{{ $tag->title }}</span></a>
        @endforeach
    @endif

    @if (!empty($model->category))
    <a href="{{  route('blog.category', ['slug' => $model->category->slug]) }}">
        <span class="badge badge-lg badge-success">{{ $model->category->name }}</span>
    </a>
    @endif

    <hr/>
