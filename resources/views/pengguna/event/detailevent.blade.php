@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Acara</h3>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Detail Acara</li>
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
                            @if ($event)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_acara/' . $event->photo) }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                @if ($event)
                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h1>{{ $event->nama_acara }}</h1>
                            <h2>{{ $event->kategori }}</h2>
                            <hr>
                            <h3>Deskripsi Singkat</h3>
                            <p>{{ $event->deskripsi_singkat }}</p><br>
                            <h3>Informasi Acara</h3>
                            <ul>
                                <li><strong>Tanggal :</strong> {{ $event->tanggal }}</li>
                                <li><strong>Hadiah :</strong><br>
                                    @php
                                        $hadiahArr = explode("\n", $event->hadiah);
                                    @endphp
                                    @foreach ($hadiahArr as $hadiah)
                                        {{ $hadiah }}<br>
                                    @endforeach
                                </li>
                                <li><strong>Kontak :</strong> {{ $event->kontak }}</li>
                                <li><strong>Alamat :</strong> {{ $event->alamat }}</li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            <h3>Lokasi Acara</h3>
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                    <div id="route-instructions"></div>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    @if (isset($event))
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
            var map = L.map('map').setView([{{ $event->latitude }}, {{ $event->longitude }}], 13);

            // Tambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var customIcon = L.icon({
                iconUrl: '/storage/Marker/Acara.png', // Ubah path sesuai dengan direktori storage
                iconSize: [60, 60],
                iconAnchor: [25, 50],
            });

            var marker = L.marker([{{ $event->latitude }}, {{ $event->longitude }}], {
                icon: customIcon,
            }).addTo(map);

            // Tambahkan popup untuk menampilkan informasi nama event dan alamat event pada marker
            function showPopupData() {
                marker.bindPopup(
                    "<b>{{ $event->nama_event }}</b><br>{{ $event->alamat }}<br><a href='{{ route('ruteevent', $event->id) }}'>Lihat Rute</a>"
                    ).openPopup();
            }

            // Tambahkan event listener untuk menampilkan popup data ketika marker diklik
            marker.on('click', showPopupData);
        </script>
    @endif
@endsection

