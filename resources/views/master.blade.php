<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sportsmap - Your guide to where to play sports in the UK</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    <link href='/css/bulma.min.css' rel='stylesheet' />
    <link href='/css/app.css' rel='stylesheet' />
</head>
<body>
    <div id="outer">
        <header>
            <nav class="navbar">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">Sportsmap</a>
                </div>
                <div class="navbar-menu is-active">
                    <div class="navbar-end">
                        @guest
                        <div class="navbar-item">
                            <div class="buttons">
                                <a href="/register" class="button is-primary">Register</a>
                                <a href="/login" class="button">Login</a>
                            </div>
                        </div>
                        @else
                            <div class="navbar-item">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="navbar-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="button is-danger">Log Out</button>
                                </form>
                            </div>
                        @endguest
                    </div>

                </div>
            </nav>
        </header>
        <div id="content">
            @yield('content')
        </div>
        <footer>
            Footer
        </footer>
    </div>
    @yield('script')
    @yield('modals')
</body>
</html>
