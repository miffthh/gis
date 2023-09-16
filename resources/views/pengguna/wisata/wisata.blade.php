@extends('layout.templateuser')

@section('container')
    <!-- ======= Wisata Section ======= -->
    <section id="wisata" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Wisata</h2>
                <p>Wisata yang Ada di Kabupaten Bandung</p>
            </div>
            <!-- Search Bar -->
            <div class="search-bar row g-3 justify-content-center mb-3" data-aos="fade-up">
                <div class="col-auto">
                    <form class="search-form" action="/wisata" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                                placeholder="Ketik Nama Wisata">
                            <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/wisata" type="button" class="btn btn-info"><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>
            <!-- End Search -->

            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @if (isset($wisata))
                            @php
                                $wisataArray = $wisata->toArray();
                                $uniqueCategories = array_unique(array_column($wisataArray, 'kategori'));
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
                @if (isset($wisata))
                    @foreach ($wisata as $w)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower(str_replace(' ', '', $w->kategori)) }}">
                            <div class="portfolio-wrap">
                                <img src="{{ asset('storage/photo_wisata/' . $w->photo1) }}" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $w->nama_wisata }}</h4>
                                    <p>{{ $w->kategori }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ asset('storage/photo_wisata/' . $w->photo2) }}"
                                            data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i
                                                class="bx bx-plus"></i></a>
                                        <a href="/detailwisata/{{ $w->id }}" title="More Details"><i
                                                class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </section>
    <!-- End Wisata Section -->
@endsection
