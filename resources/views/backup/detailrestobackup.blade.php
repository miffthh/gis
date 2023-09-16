@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Resto</h3>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Detail Resto</li>
                </ol>
            </div>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Resto Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            @if ($resto)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_resto/' . $resto->photo1) }}" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_resto/' . $resto->photo2) }}" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_resto/' . $resto->photo3) }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                @if ($resto)
                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h1>{{ $resto->nama_resto }}</h1>
                            <h3>{{ $resto->kategori_resto }}</h3>
                            <h3>Deskripsi Singkat</h3>
                            <p>{{ $resto->deskripsi_singkat }}</p>
                            <br>
                            <h3>Informasi Resto</h3>
                            <ul>
                                <li><strong>Jam Operasional</strong>: {{ $resto->jam_operasional }}</li>
                                <li><strong>Kontak :</strong> {{ $resto->kontak }}</li>
                                <li><strong>Alamat :</strong> {{ $resto->alamat }}</li>
                            </ul>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $resto->latitude }},{{ $resto->longitude }}"
                                class="btn btn-sm" target="_blank">Lihat Rute</a>
                        </div>
                    </div>
                @endif
            </div>
            <h3>Lokasi Resto</h3>
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                    <div id="route-instructions"></div>
                </div>
            </div>
        </div>
    </section><!-- End Resto Details Section -->

    @if ($resto)
        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine@3.3.4/dist/leaflet-routing-machine.js"></script>
        <style>
            #map {
                height: 500px;
                width: 100%;
            }

            #route-instructions {
                margin-top: 20px;
            }
        </style>
        <script>
            function initMap() {
                var resto = {!! json_encode($resto->toArray()) !!};

                var map = L.map('map').setView([resto.latitude, resto.longitude], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);

                // Menambahkan custom icon marker resto
                var customIcon = L.icon({
                    iconUrl: '/storage/marker/Resto.png',
                    iconSize: [62, 62],
                    iconAnchor: [16, 32]
                });

                // Menambahkan marker resto
                var restoMarker = L.marker([resto.latitude, resto.longitude], {
                    icon: customIcon
                }).addTo(map);
                restoMarker.bindPopup('<strong>' + resto.nama_resto + '</strong><br>' + resto.alamat +
                    '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + resto.latitude +
                    ',' + resto.longitude + '" class="btn btn-sm" target="_blank">Lihat Rute</a>');

                // Fungsi untuk menampilkan marker saat marker di klik
                function showMarker(marker) {
                    marker.on('click', function(e) {
                        var clickedMarker = e.target;
                        clickedMarker.openPopup();
                    });
                }

                // Mengambil data resto dari database dan menampilkan marker untuk setiap resto
                var $resto = {!! json_encode($resto) !!};
                $resto.forEach(function(data) {
                    var marker = L.marker([data.latitude, data.longitude], {
                        icon: customIcon
                    }).addTo(map);
                    marker.bindPopup('<strong>' + data.nama_resto + '</strong><br>' + data.alamat +
                        '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + data.latitude +
                        ',' + data.longitude + '" class="btn btn-sm" target="_blank">Lihat Rute</a>');
                    showMarker(marker);
                });

                // Routing
                function calculateRoute() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var userLat = position.coords.latitude;
                            var userLng = position.coords.longitude;

                            var routingControl = L.Routing.control({
                                router: L.Routing.osrmv1({
                                    serviceUrl: 'https://router.project-osrm.org/route/v1'
                                }),
                                routeWhileDragging: true,
                                show: true,
                                waypoints: [
                                    L.latLng(userLat, userLng),
                                    L.latLng(resto.latitude, resto.longitude)
                                ]
                            }).addTo(map);

                            routingControl.on('routesfound', function(e) {
                                var routes = e.routes;
                                var summary = routes[0].summary;
                                var instructions = routes[0].instructions;

                                var routeInstructions = '';
                                instructions.forEach(function(instruction) {
                                    routeInstructions += '<p>' + instruction.text + '</p>';
                                });

                                document.getElementById('route-instructions').innerHTML = routeInstructions;
                            });
                        }, function(error) {
                            console.log(error);
                        });
                    } else {
                        console.log("Geolocation is not supported by this browser.");
                    }
                }
            }

            initMap();
        </script>
    @endif
@endsection
