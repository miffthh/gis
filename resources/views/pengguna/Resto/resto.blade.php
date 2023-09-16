@extends('layout.templateuser')

@section('container')
    <!-- ======= Resto Section ======= -->
    <section id="resto" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Resto & Cafe </h2>
                <p>Resto & Cafe yang Ada di Kabupaten Bandung</p>
            </div>

            <!-- Search Bar -->
            <div class="search-bar row g-3 justify-content-center mb-3" data-aos="fade-up">
                <div class="col-auto">
                    <form class="search-form" action="/resto" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                                placeholder="Ketik Nama Resto">
                            <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/resto" type="button" class="btn btn-info"><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>
            <!-- End Search -->

            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @if (isset($resto))
                            @php
                                $restoArray = $resto->toArray();
                                $uniqueCategories = array_unique(array_column($restoArray, 'kategori_resto'));
                            @endphp
                            @foreach ($uniqueCategories as $category)
                                <li data-filter=".filter-{{ strtolower(str_replace(' ', '', $category)) }}">
                                    {{ $category }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

                @if (isset($resto))
                    @foreach ($resto as $r)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower(str_replace(' ', '', $r->kategori_resto)) }} filter-jasaboga">
                            <!-- Tambahkan class 'filter-jasaboga' pada elemen portfolio-item -->
                            <div class="portfolio-wrap">
                                <img src="{{ asset('storage/photo_resto/' . $r->photo1) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $r->nama_resto }}</h4>
                                    <p>{{ $r->kategori_resto }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ asset('storage/photo_resto/' . $r->photo1) }}"
                                            data-gallery="portfolioGallery" class="portfolio-lightbox"
                                            title="Detail Foto"><i class="bx bx-plus"></i></a>
                                        <a href="/detailresto/{{ $r->id }}" title="More Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>
    <!-- End Resto Section -->
@endsection
