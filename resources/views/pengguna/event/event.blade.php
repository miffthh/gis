@extends('layout.templateuser')

@section('container')
    <!-- ======= Acara Section ======= -->
    <section id="acara" class="pricing">
        <div class="container">

            <div class="section-title">
                <h2>Acara</h2>
                <p>Berikut Merupakan Daftar Acara</p>
            </div>

            <!-- Search Bar -->
            <div class="search-bar row g-3 justify-content-center mb-3" data-aos="fade-up">
                <div class="col-auto">
                    <form class="search-form" action="/event" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                                placeholder="Ketik Nama Acara">
                            <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/event" type="button" class="btn btn-info"><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>
            <!-- End Search -->

            <div class="row">
                @if (isset($event))
                    @foreach ($event as $e)
                        <div class="col-lg-4 col-md-6">
                            <div class="box" data-aos="zoom-in-right" data-aos-delay="200">
                                <div class="d-flex align-items-left">
                                    <span>{{ $e->tanggal }}</span>
                                </div>
                                <h4>{{ $e->nama_acara }}</h4>
                                <h3>{{ $e->kategori }}</h3>
                                <p>{{ $e->deskripsi_singkat }}</p>
                                <div class="btn-wrap">
                                    <a href="/detailevent/{{ $e->id }}" class="btn-buy">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>

        </div>
    </section>
    <!-- End Acara Section -->
@endsection
