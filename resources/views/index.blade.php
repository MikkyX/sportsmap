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
@endsection
@section('script')
    <script>
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

        mapboxgl.accessToken = 'pk.eyJ1IjoibWlra3l4IiwiYSI6ImNqaHY0ZnR5MDBzeGszcG4wcmt1ajRrY2kifQ.432QEVXzc6WJxSZJTMArZQ';
        var map = new mapboxgl.Map({
            center: [-2.547855, 54.00366],
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 9
        });

        map.addControl(new mapboxgl.NavigationControl());

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
                <form action="/venue">
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
                            <input type="text" class="input" name="website" maxlength="8">
                        </div>
                    </div>
                    <div class="field">
                        <label for="telephone" class="label">Telephone Number:</label>
                        <div class="control">
                            <input type="text" class="input" name="telephone" maxlength="8">
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
