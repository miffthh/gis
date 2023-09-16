@extends('layout.templateuser')

@section('container')
    <main id="main">
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">GIS PARIWISATA</h1>
                        <h5 data-aos="fade-up" data-aos-delay="00">Website ini menampilkan berbagai informasi-informasi
                            mengenai wisata dan budaya yang berada di Kabupaten Bandung. Dinas Pariwisata dan Kebudayaan
                            Kabupaten Bandung merupakan perangkat daerah di Kabupaten Bandung Provinsi Jawa Barat yang
                            mengurusi urusan pemerintah bidang pariwisata dan bidang kebudayaan.</h5>
                        <div data-aos="fade-up" data-aos-delay="800">
                            <a href="#map" class="btn-get-started scrollto mt-3">Get Started</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                        <img src="/img/pariwisata/nimoo.jpg" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero -->
        <div class="container-fluid">
            <!-- Lokasi Wisata -->
            @if ($wisata || $penginapan || $resto || $event || $promosi)
                <div class="d-flex align-items-center">
                    <div class="container">
                        <h1 data-aos="fade-up" class="mt-4">Peta Lokasi</h1>
                    </div>
                </div>
                
                <div id="map" class="mt-4"></div>
                <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
                <style>
                    #map {
                        height: 100vh;
                        width: 100%;
                    }
                </style>
                <script>
                    var streetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                        maxZoom: 18
                    });

                    var satelliteMapLayer = L.tileLayer(
                        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                            attribution: 'Map data &copy; <a href="https://www.arcgis.com/">ArcGIS</a>',
                            maxZoom: 18
                        });

                    var googleMapLayer = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                        attribution: 'Map data &copy; <a href="https://www.google.com/">Google</a>',
                        maxZoom: 18
                    });

                    function initMap() {
                        var wisata = {!! json_encode($wisata) !!};
                        var penginapan = {!! json_encode($penginapan) !!};
                        var resto = {!! json_encode($resto) !!};
                        var event = {!! json_encode($event) !!};
                        var promosi = {!! json_encode($promosi) !!};
                        var latSum = 0;
                        var lngSum = 0;

                        var map = L.map('map', {
                            layers: [streetMapLayer] // Default layer: Street map
                        }).setView([wisata[0].latitude, wisata[0].longitude], 10);

                        // Tambahkan polyline Kabupaten Bandung
                        var kabupatenBandungCoordinates = [ /* koordinat titik polyline */ ];
                        var kabupatenBandungPolyline = L.polyline(kabupatenBandungCoordinates, {
                            color: 'red'
                        }).addTo(map);

                        var baseMaps = {
                            "Peta Jalan": streetMapLayer,
                            "Peta Satelit": satelliteMapLayer,
                            "Google Maps": googleMapLayer
                        };

                        L.control.layers(baseMaps).addTo(map);

                        // Menambahkan marker wisata
                        wisata.forEach(function(data) {
                            var marker = L.marker([data.latitude, data.longitude], {
                                icon: customIcon('wisata')
                            }).addTo(map);

                            var popupContent =
                                '<strong>' + data.nama_wisata + '</strong><br>' +
                                '<a href="/detailwisata/' + data.id + '">Lihat Detail Wisata</a><br>' +
                                '<a href="#" onclick="showRoute(' + data.id + ', \'wisata\'); return false;">Lihat Rute</a>';

                            marker.bindPopup(popupContent);

                            marker.on('click', function(e) {
                                marker.openPopup();
                            });

                            latSum += data.latitude;
                            lngSum += data.longitude;
                        });

                        // Menambahkan marker penginapan
                        penginapan.forEach(function(data) {
                            var marker = L.marker([data.latitude, data.longitude], {
                                icon: customIcon('penginapan')
                            }).addTo(map);

                            var popupContent =
                                '<strong>' + data.nama_penginapan + '</strong><br>' +
                                '<a href="/detailpenginapan/' + data.id + '">Lihat Detail Penginapan</a><br>' +
                                '<a href="#" onclick="sshowRoute(' + data.id + '); return false;">Lihat Rute</a>';

                            marker.bindPopup(popupContent);

                            marker.on('click', function(e) {
                                marker.openPopup();
                            });

                            latSum += data.latitude;
                            lngSum += data.longitude;
                        });

                        // Menambahkan marker resto
                        resto.forEach(function(data) {
                            var marker = L.marker([data.latitude, data.longitude], {
                                icon: customIcon('resto')
                            }).addTo(map);

                            var popupContent =
                                '<strong>' + data.nama_resto + '</strong><br>' +
                                '<a href="/detailresto/' + data.id + '">Lihat Detail Resto</a><br>' +
                                '<a href="#" onclick="ssshowRoute(' + data.id + '); return false;">Lihat Rute</a>';

                            marker.bindPopup(popupContent);

                            marker.on('click', function(e) {
                                marker.openPopup();
                            });

                            latSum += data.latitude;
                            lngSum += data.longitude;
                        });

                        // Menambahkan marker event
                        event.forEach(function(data) {
                            var marker = L.marker([data.latitude, data.longitude], {
                                icon: customIcon('event')
                            }).addTo(map);

                            var popupContent =
                                '<strong>' + data.nama_acara + '</strong><br>' +
                                '<a href="/detailevent/' + data.id + '">Lihat Detail Acara</a><br>' +
                                '<a href="#" onclick="sssshowRoute(' + data.id + '); return false;">Lihat Rute</a>';

                            marker.bindPopup(popupContent);

                            marker.on('click', function(e) {
                                marker.openPopup();
                            });

                            latSum += data.latitude;
                            lngSum += data.longitude;
                        });

                        // Menambahkan marker promosi
                        promosi.forEach(function(data) {
                            var marker = L.marker([data.latitude, data.longitude], {
                                icon: customIcon('promosi')
                            }).addTo(map);

                            var popupContent =
                                '<strong>' + data.nama_promosi + '</strong><br>' +
                                '<a href="/detailpromosi/' + data.id + '">Lihat Detail Promosi</a><br>' +
                                '<a href="#" onclick="ssssshowRoute(' + data.id + '); return false;">Lihat Rute</a>';

                            marker.bindPopup(popupContent);

                            marker.on('click', function(e) {
                                marker.openPopup();
                            });

                            latSum += data.latitude;
                            lngSum += data.longitude;
                        });

                        // Menghitung rata-rata latitude dan longitude
                        var latAvg = latSum / (wisata.length + penginapan.length + resto.length + event.length + promosi.length);
                        var lngAvg = lngSum / (wisata.length + penginapan.length + resto.length + event.length + promosi.length);

                        // Mengatur tampilan peta
                        map.setView([latAvg, lngAvg], 10);

                    }

                    function showRoute(id) {
                        var mapLink = '/rutewisata/' + id;
                        window.open(mapLink, '_blank');
                    }
                    function sshowRoute(id) {
                        var mapLink = '/rutepenginapan/' + id;
                        window.open(mapLink, '_blank');
                    }
                    function ssshowRoute(id) {
                        var mapLink = '/ruteresto/' + id;
                        window.open(mapLink, '_blank');
                    }
                    function sssshowRoute(id) {
                        var mapLink = '/ruteevent/' + id;
                        window.open(mapLink, '_blank');
                    }
                    function ssssshowRoute(id) {
                        var mapLink = '/rutepromosi/' + id;
                        window.open(mapLink, '_blank');
                    }

                    function customIcon(type) {
                        var iconUrl = '';
                        var iconSize = [50, 50];
                        var iconAnchor = [16, 32];

                        if (type === 'wisata') {
                            iconUrl = '/storage/marker/Wisata.png';
                        } else if (type === 'penginapan') {
                            iconUrl = '/storage/marker/Penginapan.png';
                        } else if (type === 'resto') {
                            iconUrl = '/storage/marker/Resto.png';
                        } else if (type === 'event') {
                            iconUrl = '/storage/marker/Acara.png';
                        } else if (type === 'promosi') {
                            iconUrl = '/storage/marker/Promosi.png';
                        }

                        return L.icon({
                            iconUrl: iconUrl,
                            iconSize: iconSize,
                            iconAnchor: iconAnchor
                        });
                    }

                    initMap();

                    // Mengganti layer peta saat tombol ditekan
                    document.getElementById('btn-street').addEventListener('click', function() {
                        map.removeLayer(satelliteMapLayer);
                        map.removeLayer(googleMapLayer);
                        map.addLayer(streetMapLayer);
                    });

                    document.getElementById('btn-satellite').addEventListener('click', function() {
                        map.removeLayer(streetMapLayer);
                        map.removeLayer(googleMapLayer);
                        map.addLayer(satelliteMapLayer);
                    });

                    document.getElementById('btn-google').addEventListener('click', function() {
                        map.removeLayer(streetMapLayer);
                        map.removeLayer(satelliteMapLayer);
                        map.addLayer(googleMapLayer);
                    });
                </script>
            @endif
            {{-- End Lokasi Wisata --}}
        </div>
    </main>
@endsection
