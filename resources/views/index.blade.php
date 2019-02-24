@extends('master')
@section('content')
    <div id="map"></div>
    <div id="map-help">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">Help</h4>
            </div>
            <div class="card-content">
                Double click on the map to add a new venue.
            </div>
        </div>
    </div>
@endsection
@section('script')
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
@endsection
@section('modals')

@endsection
