<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('ads.google_analytics_code') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ config('ads.google_analytics_code') }}');
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Laravel')</title>

        <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <link href="/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/site.css" rel="stylesheet" type="text/css">
        <!-- Styles -->

        <style media="all" type="text/css"> @import url(/syntaxhighlighter/styles/shCore.css); </style>
        <style media="all" type="text/css"> @import url(/syntaxhighlighter/styles/shThemeRDark.css); </style>
    <!--    <style media="all" type="text/css"> @import url(/css/bootstrap.css); </style>
        <style media="all" type="text/css"> @import url(/css/bootstrap-responsive.css); </style>-->

        <script>
            window.Laravel = {!! json_encode([
		'csrfToken' => csrf_token(),
		]) !!};
        </script>

        <!-- Scripts -->
        <script src="/js/app.js" type="text/javascript"></script>
    <!--    <script src="/jquery.js" type="text/javascript"></script>-->
        <script src="/syntaxhighlighter/scripts/shCore.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushBash.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushCpp.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushCss.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushIni.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushJScript.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushPhp.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushPlain.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushSql.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushTwig.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushXml.js" type="text/javascript"></script>
        <script src="/syntaxhighlighter/scripts/shBrushYaml.js" type="text/javascript"></script>
     <!--   <script src="/js/bootstrap.js" type="text/javascript"></script> -->

        <script type="text/javascript">
            var pathbs = 'http://dmitxe.ru';
            var typeGet="0";
            if(!window.VK) {
                document.write(unescape('<script type="text/javascript" src="http://vk.com/js/api/openapi.js">%3C/script%3E'));
            }
        </script>
        <script type="text/javascript" src="/js/jlike/buttons.js"></script>
        <script type="text/javascript">
            // SyntaxHighlighter.config.bloggerMode = true;
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
            // hljs.initHighlightingOnLoad();
        </script>
    </head>
    <body>
    <div class="wrap">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" id="mainmenu">
        <div class="container">
        <a class="navbar-brand" href="javascript:void(0)">Блог веб-программиста</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            {!! menu('main', 'bootstrap4-menu') !!}
            <div class="navbar-nav">
                <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('login') }}">Войти</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link"  href="{{ route('register') }}">Зарегистрироваться</a></li>
                    @endif
                @endauth
                </ul>
            </div>
        </div>
        </div>
    </nav>
   <div class="container" id="main-container">
       <div class="row">
           <div id="header" class="col-sm-12">
               <div id="logo"></div>
           </div>
       </div>
       <div class="row">
           <div class="col-sm-12">
               @yield('breadcrumbs')
           </div>
       </div>
       <div class="row">
           <div class="col-sm-3">
               @widget('AdsWidget', ['position' => 'sidebar'])
               @widget('CategoryBlog')
               @widget('ArchiveWidget')
               @widget('TagWidget')
           </div>
           <div class="col-sm-9">
               @yield('content')
           </div>
       </div>
    </div>
        </div>
    <footer id="footer" class="fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        @2011 - {{ date('Y') }} Дмитрий Хе. Все права защищены.
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>
