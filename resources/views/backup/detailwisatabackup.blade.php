@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Wisata</h3>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Detail Wisata</li>
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
                            @if ($wisata)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_wisata/' . $wisata->photo1) }}" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_wisata/' . $wisata->photo2) }}" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_wisata/' . $wisata->photo3) }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Lokasi Wisata -->
                    <div class="mt-4">
                        <h3> Lokasi Wisata</h3>
                        <div id="map" style="height: 500px; width: 100%;"></div>
                        <div id="route-instructions"></div>
                    </div>
                    <!-- End Lokasi -->
                </div>

                <div class="col-lg-4">
                    @if ($wisata)
                        <div class="portfolio-info">
                            <h1>{{ $wisata->nama_wisata }}</h1>
                            <h3>{{ $wisata->kategori }}</h3>
                            <h3>Deskripsi Singkat</h3>
                            <p>{{ $wisata->deskripsi_singkat }}</p>
                            <br>
                            <h3>Informasi Wisata</h3>
                            <ul>
                                <li><strong>Harga Tiket :</strong> Rp. {{ $wisata->harga_tiket }}</li>
                                <li><strong>Akses Kendaraan :</strong></li>
                                <ul>
                                    @foreach (explode("\n", $wisata->akses_kendaraan) as $akses)
                                        @if (!empty($akses))
                                            <li>&bull; {{ $akses }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                <li><strong>Jam Operasional :</strong> {{ $wisata->jam_operasional }}</li>
                                <li><strong>Website :</strong> <a href="{{ $wisata->website }}">{{ $wisata->website }}</a>
                                </li>
                                <li><strong>Kontak :</strong> {{ $wisata->kontak }}</li>
                                <li><strong>Fasilitas :</strong></li>
                                <ul>
                                    @foreach (explode("\n", $wisata->fasilitas) as $fasilitas)
                                        @if (!empty($fasilitas))
                                            <li>&bull; {{ $fasilitas }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                <li><strong>Alamat :</strong> {{ $wisata->alamat }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->

    @if ($wisata)
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
                var wisata = {!! json_encode($wisata->toArray()) !!};

                var map = L.map('map').setView([wisata.latitude, wisata.longitude], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);

                // Menambahkan custom icon marker wisata
                var customIcon = L.icon({
                    iconUrl: '/storage/marker/Wisata.png',
                    iconSize: [62, 62],
                    iconAnchor: [16, 32]
                });

                // Menambahkan marker wisata
                var wisataMarker = L.marker([wisata.latitude, wisata.longitude], {
                    icon: customIcon
                }).addTo(map);
                wisataMarker.bindPopup('<strong>' + wisata.nama_wisata + '</strong><br>' + wisata.alamat +
                    '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + wisata.latitude + ',' + wisata
                    .longitude + '" class="btn" target="_blank">Lihat Rute</a>');

                // Fungsi untuk menampilkan marker saat marker di klik
                function showMarker(marker) {
                    marker.on('click', function(e) {
                        var clickedMarker = e.target;
                        clickedMarker.openPopup();
                    });
                }

                // Mengambil data titik wisata dari database dan menampilkan marker untuk setiap titik wisata
                var $wisata = {!! json_encode($wisata) !!};
                $wisata.forEach(function(data) {
                    var marker = L.marker([data.latitude, data.longitude], {
                        icon: customIcon
                    }).addTo(map);
                    marker.bindPopup('<strong>' + data.nama_wisata + '</strong><br>' + data.alamat +
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
                                    L.latLng(wisata.latitude, wisata.longitude)
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
