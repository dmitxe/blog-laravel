<div class="panel panel-info portlet">
    <div class="panel-heading portlet-decoration">
        <div class="portlet-title">Архив статей</div>
    </div>
    <div class="body portlet-content">
        <div id="archive_blog">
            <ul class="nav nav-pills nav-stacked">
                @foreach($models as $model)
                    <li class="nav-item">
                        <?php $data = new Jenssegers\Date\Date($model->created_at);?>
                        <a class="nav-link" href="{{ route('blog.archive', ['year' => $model->year, 'month' => $model->month ]) }}"> {{  $data->format('F Y') }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
