@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Promosi</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Detail Promosi</li>
                </ol>
            </div>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            @if ($promosi)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_promosi/' . $promosi->photo) }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                @if ($promosi)
                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h1>{{ $promosi->nama_promosi }}</h1>
                            <h3>Deskripsi Singkat</h3>
                            <p>{{ $promosi->deskripsi_singkat }}</p><br>
                            <h3>Informasi Promosi</h3>
                            <ul>
                                <li><strong>Dari Tanggal:</strong> {{ $promosi->tgl_awal }}</li>
                                <li><strong>Sampai Tanggal:</strong> {{ $promosi->tgl_akhir }}</li>
                                <li><strong>Harga Awal:</strong> Rp. {{ $promosi->harga_awal }}</li>
                                <li><strong>Harga Promo:</strong> Rp. {{ $promosi->harga_promo }}</li>
                                <li>
                                    <strong>Syarat & Ketentuan:</strong><br>
                                    {!! nl2br($promosi->sk) !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <h3>Lokasi Promosi</h3>
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                    <div id="route-instructions"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio Details Section -->

    @if ($promosi)
        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
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
                var promosi = {!! json_encode($promosi->toArray()) !!};

                var map = L.map('map').setView([promosi.latitude, promosi.longitude], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);

                // Menambahkan custom icon marker promosi
                var customIcon = L.icon({
                    iconUrl: '{{ asset('storage/marker/Promosi.png') }}',
                    iconSize: [62, 62],
                    iconAnchor: [16, 32]
                });

                // Menambahkan marker promosi
                var promosiMarker = L.marker([promosi.latitude, promosi.longitude], {
                    icon: customIcon
                }).addTo(map);
                promosiMarker.bindPopup('<strong>' + promosi.nama_promosi + '</strong><br>' + promosi.alamat +
                    '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + promosi.latitude +
                    ',' + promosi.longitude + '" class="btn btn-sm" target="_blank">Lihat Rute</a>');

                // Fungsi untuk menampilkan marker saat marker di klik
                function showMarker(marker) {
                    marker.on('click', function(e) {
                        var clickedMarker = e.target;
                        clickedMarker.openPopup();
                    });
                }

                // Mengambil data promosi dari database dan menampilkan marker untuk setiap promosi
                var $promosi = {!! json_encode($promosi) !!};
                $promosi.forEach(function(data) {
                    var marker = L.marker([data.latitude, data.longitude], {
                        icon: customIcon
                    }).addTo(map);
                    marker.bindPopup('<strong>' + data.nama_promosi + '</strong><br>' + data.alamat +
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
                                    L.latLng(promosi.latitude, promosi.longitude)
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

                calculateRoute();
            }

            initMap();
        </script>
    @endif
@endsection
