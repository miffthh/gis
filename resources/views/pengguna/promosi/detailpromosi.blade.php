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
                            <hr>
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

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    @if (isset($promosi))
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
            var map = L.map('map').setView([{{ $promosi->latitude }}, {{ $promosi->longitude }}], 13);

            // Tambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            var customIcon = L.icon({
                iconUrl: '/storage/Marker/Promosi.png', // Ubah path sesuai dengan direktori storage
                iconSize: [60, 60],
                iconAnchor: [25, 50],
            });

            var marker = L.marker([{{ $promosi->latitude }}, {{ $promosi->longitude }}], {
                icon: customIcon,
            }).addTo(map);

            // Tambahkan popup untuk menampilkan informasi nama promosi dan alamat promosi pada marker
            function showPopupData() {
                marker.bindPopup(
                    "<b>{{ $promosi->nama_promosi }}</b><br>{{ $promosi->alamat }}<br><a href='{{ route('rutepromosi', $promosi->id) }}'>Lihat Rute</a>"
                    ).openPopup();
            }

            // Tambahkan event listener untuk menampilkan popup data ketika marker diklik
            marker.on('click', showPopupData);
        </script>
    @endif
@endsection
