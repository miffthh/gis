@extends('layout.templateuser')

@section('container')
    <!-- ======= Acara Section ======= -->
    <section id="acara" class="pricing">
        <div class="container">

            <div class="section-title">
                <h2>Promosi</h2>
                <p>Berikut Merupakan Daftar Promosi</p>
            </div>

            <!-- Search Bar -->
            <div class="search-bar row g-3 justify-content-center mb-3" data-aos="fade-up">
                <div class="col-auto">
                    <form class="search-form" action="/promosi" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                                placeholder="Ketik Nama Promosi">
                            <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/promosi" type="button" class="btn btn-info"><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>
            <!-- End Search -->

            <div class="row">
                @if (isset($promosi))
                    @foreach ($promosi as $pr)
                        <div class="col-lg-4 col-md-6">
                            <div class="box" data-aos="zoom-in-right" data-aos-delay="200">
                                <h4>{{ $pr->nama_promosi }}</h4>
                                <s>
                                    <h3>{{ $pr->harga_awal }}</h3>
                                </s>
                                <h2>{{ $pr->harga_promo }}</h2>
                                <span>Promo mulai dari tanggal {{ $pr->tgl_awal }} s.d {{ $pr->tgl_akhir }}</span>
                                <b><i>
                                        <p>*syarat dan ketentuan berlaku</p>
                                    </i></b>
                                <div class="btn-wrap">
                                    <a href="/detailpromosi/{{ $pr->id }}" class="btn-buy">Detail</a>
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
