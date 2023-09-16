@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Penginapan</h3>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Detail Penginapan</li>
                </ol>
            </div>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Penginapan Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            @if ($penginapan)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_penginapan/' . $penginapan->photo1) }}"
                                        alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_penginapan/' . $penginapan->photo2) }}"
                                        alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/photo_penginapan/' . $penginapan->photo3) }}"
                                        alt="">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                @if ($penginapan)
                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h1>{{ $penginapan->nama_penginapan }}</h1>
                            <h3>{{ $penginapan->kategori_penginapan }}</h3>
                            <h3>Deskripsi Singkat</h3>
                            <p>{{ $penginapan->deskripsi_singkat }}</p>
                            <br>
                            <h3>Informasi Penginapan</h3>
                            <ul>
                                <li><strong>Website</strong>: <a
                                        href="{{ $penginapan->website }}">{{ $penginapan->website }}</a></li>
                                <li><strong>Kontak :</strong> {{ $penginapan->kontak }}</li>
                                <li><strong>Alamat :</strong> {{ $penginapan->alamat }}</li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            <h3>Lokasi Penginapan</h3>
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                    <div id="route-instructions"></div>
                </div>
            </div>
        </div>
    </section><!-- End Penginapan Details Section -->

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    @if (isset($penginapan))
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
            var map = L.map('map').setView([{{ $penginapan->latitude }}, {{ $penginapan->longitude }}], 13);

            // Tambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var customIcon = L.icon({
                iconUrl: '/storage/Marker/Penginapan.png', // Ubah path sesuai dengan direktori storage
                iconSize: [60, 60],
                iconAnchor: [25, 50],
            });

            var marker = L.marker([{{ $penginapan->latitude }}, {{ $penginapan->longitude }}], {
                icon: customIcon,
            }).addTo(map);

            // Tambahkan popup untuk menampilkan informasi nama penginapan dan alamat penginapan pada marker
            function showPopupData() {
                marker.bindPopup(
                    "<b>{{ $penginapan->nama_penginapan }}</b><br>{{ $penginapan->alamat }}<br><a href='{{ route('rutepenginapan', $penginapan->id) }}'>Lihat Rute</a>"
                    ).openPopup();
            }

            // Tambahkan event listener untuk menampilkan popup data ketika marker diklik
            marker.on('click', showPopupData);
        </script>
    @endif
@endsection
