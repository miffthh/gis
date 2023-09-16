@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Rute Wisata</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Rute Wisata</li>
                </ol>
            </div>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Route Section ======= -->
    <section id="route" class="route">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container"><h4>Rute Menuju {{ $wisata->nama_wisata }}</h4></div>
                    <div id="map" style="height: 100vh;"></div>
                    <div id="route-instructions"></div>
                </div>
            </div>
        </div>
    </section><!-- End Route Section -->

    @if ($wisata)
        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
        <style>
            #map {
                height: 100vh;
                width: 100%;
            }
            #route-instructions {
                margin-top: 20px;
            }
        </style>
        <script>
            function initMap() {
                var map = L.map('map').setView([{{ $wisata->latitude }}, {{ $wisata->longitude }}], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);


                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;

                        var routingControl = L.Routing.control({
                            router: L.Routing.osrmv1({
                                serviceUrl: 'https://router.project-osrm.org/route/v1'
                            }),
                            routeWhileDragging: true,
                            waypoints: [
                                L.latLng(userLat, userLng),
                                L.latLng({{ $wisata->latitude }}, {{ $wisata->longitude }})
                            ]
                        }).addTo(map);

                        routingControl.on('routesfound', function (e) {
                            var routes = e.routes;
                            var summary = routes[0].summary;
                            var instructions = routes[0].instructions;

                            var routeInstructions = '<ul>';
                            instructions.forEach(function (instruction) {
                                routeInstructions ;
                            });
                            routeInstructions += '</ul>';

                            document.getElementById('route-instructions').innerHTML = routeInstructions;
                        });
                    }, function (error) {
                        console.log(error);
                    });
                } else {
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            initMap();
        </script>
    @endif
@endsection
