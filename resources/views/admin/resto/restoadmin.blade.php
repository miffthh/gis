@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Resto & Cafe</h3>
            <hr>
            <h6>Data Resto & Cafe</h6>
        </div>
    </div>
    <div class="container">
        <a href="tambahrestoadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'Admin')
            <a href="/ekspooortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/eeksportexceel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/restoadmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>
    <!-- Filter Tanggal -->

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/restoadmin" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Resto">
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- End Search -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table">
                        <thead class="table-info" id="records">
                            <tr align="center">
                                <th cscope="row"> No</th>
                                <th>Nama Resto</th>
                                <th>Kategori Resto</th>
                                <th>Deskripsi Singkat</th>
                                <th>Jam Operasional</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Gambar 1</th>
                                <th>Gambar 2</th>
                                <th>Gambar 3</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($resto as $index => $r)
                                <tr>
                                    <td scope="row">{{ $index + $resto->firstItem() }}</td>
                                    <td>{{ $r->nama_resto }}</td>
                                    <td>{{ $r->kategori_resto }}</td>
                                    <td>{!! nl2br($r->deskripsi_singkat) !!}</td>
                                    <td>{!! nl2br($r->jam_operasional) !!}</td>
                                    <td>{{ $r->kontak }}</td>
                                    <td>{{ $r->alamat }}</td>
                                    <td>{{ $r->latitude }}</td>
                                    <td>{{ $r->longitude }}</td>
                                    <td>
                                        <img src="{{ asset('storage/photo_resto/' . $r->photo1) }}" width="70%">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/photo_resto/' . $r->photo2) }}" width="70%">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/photo_resto/' . $r->photo3) }}" width="70%">
                                    </td>
                                    <td>
                                        <a href="/editrestoadmin/{{ $r->id }}" type="button"
                                            class="btn btn-warning">Edit</a>
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="#" type="button" class="btn btn-danger hapus"
                                                data-id="{{ $r->id }}" data-nama="{{ $r->nama_resto }}">Hapus</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginasi -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">Halaman {{ $resto->currentPage() }} dari
                            {{ $resto->lastPage() }}</span>
                    </div>
                    <div>
                        <nav aria-label="Halaman">
                            <ul class="pagination justify-content-end mb-0">
                                @if ($resto->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $resto->previousPageUrl() }}">Sebelumnya</a>
                                    </li>
                                @endif

                                @foreach ($resto->getUrlRange(1, $resto->lastPage()) as $page => $url)
                                    @if ($page == $resto->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($resto->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $resto->nextPageUrl() }}">Selanjutnya</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Selanjutnya</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                {{-- End Paginasi --}}
            </div>
        </div>
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data Penginapan --}}
    <script>
        $('.hapus').click(function() {
            var restoid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');


            swal({
                    title: "Apakah Yakin ?",
                    text: "Data dengan nama " + nama + " akan dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/hapuss/" + restoid + ""
                        swal("Data berhasil dihapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus!");
                    }
                });

        });
    </script>
@endpush
