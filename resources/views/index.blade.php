@extends('master')
@section('content')
    <div id="map"></div>
    <div id="map-help">
        <div class="card is-small">
            <div class="card-header">
                <h4 class="card-header-title">Help</h4>
            </div>
            <div class="card-content">
                <p>Drag to scroll and use the mouse wheel to zoom.</p>
                @auth
                    <p>Double click on the map to add a new venue at that position.</p>
                @else
                    <p>You must <a href="/register">register</a> before you can add a new venue.</p>
                @endauth
            </div>
        </div>
    </div>
    <div class="message is-success" id="update-message">
        <div class="message-body">
            Updating map...
        </div>
    </div>
@endsection
@section('script')
    <script>
        var map;
        var markers = Array();
        var updateTimer;
        var venueForm;

        @auth
        function showVenueForm(e) {
             venueForm = document.getElementById('venue-add-form');

            // Populate the form
            document.getElementById('latitude').value = e.lngLat.lat;
            document.getElementById('longitude').value = e.lngLat.lng;

            if (!venueForm.classList.contains('is-active')) {
                venueForm.classList.add('is-active');
            }

            document.getElementById('venue-form-close').onclick = function() {
                venueForm.classList.remove('is-active');
            }
        }
        @endauth

        function updateMarkers() {
            document.getElementById('update-message').classList.add('visible');

            bounds = map.getBounds();
            querystring = 'nelat='+bounds._ne.lat+
                '&nelng='+bounds._ne.lng+
                '&swlat='+bounds._sw.lat+
                '&swlng='+bounds._sw.lng;

            xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var venues = JSON.parse(xmlhttp.responseText);
                    wipeMarkers();

                    for (var v = 0; v < venues.length; v++) {
                        markers.push(
                            new mapboxgl.Marker()
                                .setLngLat([
                                    venues[v].longitude,
                                    venues[v].latitude
                                ])
                                .setPopup(
                                    new mapboxgl.Popup({
                                        offset: 25
                                    }).setHTML(
                                        '<h5 class="is-size-5">'+venues[v].name+'</h5>'+
                                        '<p>'+venues[v].address+'<br>'+
                                        venues[v].postcode+'</p>'
                                    )
                                )
                                .addTo(map)
                        );
                    }

                    document.getElementById('update-message').classList.remove('visible');
                }
            };

            xmlhttp.open("GET", '/venue-search?'+querystring, true);
            xmlhttp.send();
        }

        function wipeMarkers() {
            for (var m = 0; m < markers.length; m++) {
                markers[m].remove();
            }
        }

        mapboxgl.accessToken = 'pk.eyJ1IjoibWlra3l4IiwiYSI6ImNqaHY0ZnR5MDBzeGszcG4wcmt1ajRrY2kifQ.432QEVXzc6WJxSZJTMArZQ';
        map = new mapboxgl.Map({
            center: [-2.547855, 54.00366],
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 9
        });

        map.addControl(new mapboxgl.NavigationControl());

        map.on('render', function() {
            clearTimeout(updateTimer);
            updateTimer = setTimeout(updateMarkers, 250);
        });

        @auth
        map.on('dblclick', function(e) {
            showVenueForm(e);
        });
        @endauth
    </script>
@endsection
@section('modals')
    @auth
    <div class="modal" id="venue-add-form">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <h4 class="is-size-4">Add New Venue</h4>
                <form action="/venues" method="post">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <div class="field">
                        <label for="name" class="label">Name:</label>
                        <div class="control">
                            <input type="text" class="input" name="name">
                        </div>
                    </div>
                    <div class="field">
                        <label for="address" class="label">Address:</label>
                        <div class="control">
                            <input type="text" class="input" name="address">
                        </div>
                    </div>
                    <div class="field">
                        <label for="postcode" class="label">Postcode:</label>
                        <div class="control">
                            <input type="text" class="input" name="postcode" maxlength="8">
                        </div>
                    </div>
                    <div class="field">
                        <label for="website" class="label">Website:</label>
                        <div class="control">
                            <input type="text" class="input" name="website">
                        </div>
                    </div>
                    <div class="field">
                        <label for="telephone" class="label">Telephone Number:</label>
                        <div class="control">
                            <input type="text" class="input" name="telephone">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary">Add Venue</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <button class="modal-close is-large" id="venue-form-close" aria-label="close"></button>
    </div>
    @endauth
@endsection
