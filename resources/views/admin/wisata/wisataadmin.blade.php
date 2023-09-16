@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Wisata</h3>
            <hr>
            <h6>Data Wisata</h6>
        </div>
    </div>

    <div class="container">
        <a href="/tambahwisataadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'Admin')
            <a href="/eksportpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/eksportexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/wisataadmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>

        {{-- Search Bar --}}
        <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
            <div class="col-auto">
                <form class="search-form" action="/wisataadmin" method="get">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                        <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                            placeholder="Ketik Nama Wisata">
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Search --}}

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-primary" id="records">
                        <tr align="center">
                            <th cscope="row">No</th>
                            <th>Nama Wisata</th>
                            <th>Kategori Wisata</th>
                            <th>Deskripsi Singkat</th>
                            <th>Harga Tiket</th>
                            <th>Akses Kendaraan</th>
                            <th>Jam Operasional</th>
                            <th>Website</th>
                            <th>Kontak</th>
                            <th>Fasilitas</th>
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
                        @foreach ($wisata as $index => $w)
                            <tr>
                                <td scope="row">{{ $index + $wisata->firstItem() }}</td>
                                <td>{{ $w->nama_wisata }}</td>
                                <td>{{ $w->kategori }}</td>
                                <td>{!! nl2br($w->deskripsi_singkat) !!}</td>
                                <td>{!! nl2br($w->harga_tiket) !!}</td>
                                <td>{{ $w->akses_kendaraan }}</td>
                                <td>{!! nl2br($w->jam_operasional) !!}</td>
                                <td>{{ $w->website }}</td>
                                <td>{{ $w->kontak }}</td>
                                <td>{{ $w->fasilitas }}</td>
                                <td>{{ $w->alamat }}</td>
                                <td>{{ $w->latitude }}</td>
                                <td>{{ $w->longitude }}</td>
                                <td>
                                    <img src="{{ asset('storage/photo_wisata/' . $w->photo1) }}" width="70%">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/photo_wisata/' . $w->photo2) }}" width="70%">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/photo_wisata/' . $w->photo3) }}" width="70%">
                                </td>
                                <td>
                                    <a href="/editwisataadmin/{{ $w->id }}" type="button"
                                        class="btn btn-warning">Edit</a>
                                    @if (auth()->user()->role == 'Admin')
                                        <a href="#" type="button" class="btn btn-danger hapus"
                                            data-id="{{ $w->id }}" data-nama="{{ $w->nama_wisata }}">Hapus</a>
                                </td>
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginasi -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="text-muted">Halaman {{ $wisata->currentPage() }} dari {{ $wisata->lastPage() }}</span>
                </div>
                <div>
                    <nav aria-label="Halaman">
                        <ul class="pagination justify-content-end mb-0">
                            @if ($wisata->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $wisata->previousPageUrl() }}">Sebelumnya</a>
                                </li>
                            @endif

                            @foreach ($wisata->getUrlRange(1, $wisata->lastPage()) as $page => $url)
                                @if ($page == $wisata->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($wisata->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $wisata->nextPageUrl() }}">Selanjutnya</a>
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
@endsection

@push('append-script')
    {{-- Hapus Data Wisata --}}
    <script>
        $('.hapus').click(function() {
            var wisataid = $(this).attr('data-id');
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
                        window.location = "/hapus/" + wisataid + ""
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
