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

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    @if (isset($resto))
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
            // Inisialisasi peta
            var map = L.map('map').setView([{{ $resto->latitude }}, {{ $resto->longitude }}], 13);

            // Tambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var customIcon = L.icon({
                iconUrl: '/storage/Marker/Resto.png', // Ubah path sesuai dengan direktori storage
                iconSize: [60, 60],
                iconAnchor: [25, 50],
            });

            var marker = L.marker([{{ $resto->latitude }}, {{ $resto->longitude }}], {
                icon: customIcon,
            }).addTo(map);

            // Tambahkan popup untuk menampilkan informasi nama resto dan alamat resto pada marker
            function showPopupData() {
                marker.bindPopup(
                    "<b>{{ $resto->nama_resto }}</b><br>{{ $resto->alamat }}<br><a href='{{ route('ruteresto', $resto->id) }}'>Lihat Rute</a>"
                    ).openPopup();
            }

            // Tambahkan event listener untuk menampilkan popup data ketika marker diklik
            marker.on('click', showPopupData);
        </script>
    @endif
@endsection
