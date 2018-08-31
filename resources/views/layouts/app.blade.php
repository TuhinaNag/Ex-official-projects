<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--Script--}}
    <script src="{{ asset('js/app.js') }}" ></script>
    <!-- Custom Integration-->
    <!-- Sweet alert cdn-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap for Datatable-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Script for Datatable-->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>

    @yield('styles')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            @if(!Auth::guest())
                <a class="navbar-brand" href="{{ url('dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto float-right">
                    <!-- Authentication Links -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::guest())
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('dashboard') }}">
                                        Home
                                    </a></div>
                                <div class="col-md-8">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        @endif
                    </ul>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="row">
            <div class="col-1 ">

            </div>
            <div class="col-10">
                @yield('content')
            </div>
            <div class="col-1">

            </div>
        </div>

    </main>
</div>
@yield('scripts')
<!--Custom js for modal functionality -->
<script type="text/javascript" src="{{ asset('js/modalFunctionality.js') }}"></script>
<script>
window.fbMessengerPlugins = window.fbMessengerPlugins || {
init: function () {
FB.init({
appId : '1678638095724206',
autoLogAppEvents : true,
xfbml : true,
version : 'v3.0'
});
}, callable: []
};
window.fbAsyncInit = window.fbAsyncInit || function () {
window.fbMessengerPlugins.callable.forEach(function (item) { item(); });
window.fbMessengerPlugins.init();
};
setTimeout(function () {
(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) { return; }
js = d.createElement(s);
js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
}, 0);
</script>

<div
class="fb-customerchat"
page_id="322931785116529"
ref="INSIDE-LOGIN">
</div>

</body>
</html>
