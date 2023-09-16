@extends('layout.templateuser')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Wisata</h3>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
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

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    @if (isset($wisata))
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
            var map = L.map('map').setView([{{ $wisata->latitude }}, {{ $wisata->longitude }}], 13);

            // Tambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            var customIcon = L.icon({
                iconUrl: '/storage/Marker/Wisata.png', // Ubah path sesuai dengan direktori storage
                iconSize: [60, 60],
                iconAnchor: [25, 50],
            });

            var marker = L.marker([{{ $wisata->latitude }}, {{ $wisata->longitude }}], {
                icon: customIcon,
            }).addTo(map);

            // Tambahkan popup untuk menampilkan informasi nama wisata dan alamat wisata pada marker
            function showPopupData() {
                marker.bindPopup(
                    "<b>{{ $wisata->nama_wisata }}</b><br>{{ $wisata->alamat }}<br><a href='{{ route('rutewisata', $wisata->id) }}'>Lihat Rute</a>"
                ).openPopup();
            }

            // Tambahkan event listener untuk menampilkan popup data ketika marker diklik
            marker.on('click', showPopupData);
        </script>
    @endif
@endsection
