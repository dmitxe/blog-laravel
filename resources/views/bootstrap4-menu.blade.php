<ul class="navbar-nav mr-auto">
    @foreach($items as $menu_item)
        <li class="nav-item {{ ($_SERVER['REQUEST_URI'] == $menu_item->url) ? 'active' : '' }}"><a class="nav-link" href="{{ $menu_item->url }}">{{ $menu_item->title }}</a></li>
    @endforeach
</ul>

