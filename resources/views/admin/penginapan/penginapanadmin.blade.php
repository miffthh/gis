@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Penginapan</h3>
            <hr>
            <h6>Data Penginapan</h6>
        </div>
    </div>
    <div class="container">
        <a href="tambahpenginapanadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'Admin')
            <a href="/ekspoortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/eksportexcell" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/penginapanadmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/penginapanadmin" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Penginapan">
                </div>
            </form>
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
                                <th cscope="row">No</th>
                                <th>Nama Penginapan</th>
                                <th>Kategori Penginapan</th>
                                <th>Deskripsi Singkat</th>
                                <th>Website</th>
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
                            @foreach ($penginapan as $index => $p)
                                <tr>
                                    <td scope="row">{{ $index + $penginapan->firstItem() }}</td>
                                    <td>{{ $p->nama_penginapan }}</td>
                                    <td>{{ $p->kategori_penginapan }}</td>
                                    <td>{!! nl2br($p->deskripsi_singkat) !!}</td>
                                    <td>{{ $p->website }}</td>
                                    <td>{{ $p->kontak }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->latitude }}</td>
                                    <td>{{ $p->longitude }}</td>
                                    <td>
                                        <img src="{{ asset('storage/photo_penginapan/' . $p->photo1) }}" width="70%">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/photo_penginapan/' . $p->photo2) }}" width="70%">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/photo_penginapan/' . $p->photo3) }}" width="70%">
                                    </td>
                                    <td>
                                        <a href="/editpenginapanadmin/{{ $p->id }}" type="button"
                                            class="btn btn-warning">Edit</a>
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="#" type="button" class="btn btn-danger hapus"
                                                data-id="{{ $p->id }}"
                                                data-nama="{{ $p->nama_penginapan }}">Hapus</a>
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
                        <span class="text-muted">Halaman {{ $penginapan->currentPage() }} dari
                            {{ $penginapan->lastPage() }}</span>
                    </div>
                    <div>
                        <nav aria-label="Halaman">
                            <ul class="pagination justify-content-end mb-0">
                                @if ($penginapan->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $penginapan->previousPageUrl() }}">Sebelumnya</a>
                                    </li>
                                @endif

                                @foreach ($penginapan->getUrlRange(1, $penginapan->lastPage()) as $page => $url)
                                    @if ($page == $penginapan->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($penginapan->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $penginapan->nextPageUrl() }}">Selanjutnya</a>
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
            var penginapanid = $(this).attr('data-id');
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
                        window.location = "/hapusss/" + penginapanid + ""
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
