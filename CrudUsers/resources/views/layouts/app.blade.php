<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset("/css/app.css")}}"/>
    <link rel="stylesheet" href="{{asset("/css/main.css")}}"/>
    <link rel="stylesheet" href="{{asset("/css/selectpicker-add-option.css")}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav" style="margin-left:-5%;">
                    @if (!Auth::guest())
                        <li><a href="{{url("/users/list")}}"><i class="fa fa-users"></i> Usuarios</a></li>
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container login register">
        <div class="container" style="padding-top: 10px;padding-bottom: 70px;">
            @if ($errors->any())
                <div id="error" class="alert alert-danger" role="alert">
                    <p>@yield('title_error')</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <div id="success" class="alert alert-success" style="display: none;">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('warning'))
                <div id="warning" class="alert alert-warning" style="display: none;">
                    {{ Session::get('warning') }}
                </div>
            @endif
            @if (Session::has('danger'))
                <div id="danger" class="alert alert-danger" style="display: none;">
                    {{ Session::get('danger') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{asset("/js/app.js")}}"></script>
<script src="{{asset("/js/selectpicker-add-option.js")}}"></script>
<script type="text/javascript">
    setTimeout(function () {
        $("#success").show('fast');
        $("#warning").show('fast');
        $("#danger").show('fast');
        $("#error").show('fast');
    }, 200);
    setTimeout(function () {
        $("#success").hide('fast');
        $("#warning").hide('fast');
        $("#danger").hide('fast');
        $("#error").hide('fast');
    }, 5000);
</script>
@yield('scripts')
</body>
</html>
