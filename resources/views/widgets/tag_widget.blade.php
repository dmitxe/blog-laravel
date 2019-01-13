<div class="panel panel-info portlet">
    <div class="panel-heading portlet-decoration">
        <div class="portlet-title">Облако тегов</div>
    </div>
    <div class="body portlet-content">
        <div id="tags_cloud">
            @foreach($models as $model)
                <span class="tag" style="font-size:{{ 10 + $model->weight }}pt">
                    <a href="{{ route('blog.tag', ['slug'=> $model->slug]) }}">{{ $model->title }}</a>
                </span>
            @endforeach
        </div>
    </div>
</div>