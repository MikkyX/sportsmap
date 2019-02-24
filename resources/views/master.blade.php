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
            Header
        </header>
        <div id="content">
            @yield('content')
        </div>
        <footer>
            Footer
        </footer>
    </div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibWlra3l4IiwiYSI6ImNqaHY0ZnR5MDBzeGszcG4wcmt1ajRrY2kifQ.432QEVXzc6WJxSZJTMArZQ';
        var map = new mapboxgl.Map({
            center: [-2.547855, 54.00366],
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 9
        });

        map.addControl(new mapboxgl.NavigationControl());
    </script>
</body>
</html>
