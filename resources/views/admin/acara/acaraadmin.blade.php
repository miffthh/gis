@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Acara</h3>
            <hr>
            <h6>Data Acara</h6>
        </div>
    </div>
    <div class="container">
        <a href="tambahacaraadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'Admin')
            <a href="/ekksportpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/ekssportexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/acaraadmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/acaraadmin" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Acara">
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
                                <th>Nama Acara</th>
                                <th>Kategori Acara</th>
                                <th>Deskripsi Singkat</th>
                                <th>Tanggal</th>
                                <th>Hadiah</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Photo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($acara as $index => $ac)
                                <tr>
                                    <td scope="row">{{ $index + $acara->firstItem() }}</td>
                                    <td>{{ $ac->nama_acara }}</td>
                                    <td>{{ $ac->kategori }}</td>
                                    <td>{!! nl2br($ac->deskripsi_singkat) !!}</td>
                                    <td>{{ $ac->tanggal }}</td>
                                    <td>{!! nl2br($ac->hadiah) !!}</td>
                                    <td>{{ $ac->kontak }}</td>
                                    <td>{{ $ac->alamat }}</td>
                                    <td>{{ $ac->latitude }}</td>
                                    <td>{{ $ac->longitude }}</td>
                                    <td>
                                        <img src="{{ asset('storage/photo_acara/' . $ac->photo) }}" width="70%">
                                    </td>
                                    <td>
                                        <a href="/editacaraadmin/{{ $ac->id }}" type="button"
                                            class="btn btn-warning">Edit</a>
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="#" type="button" class="btn btn-danger hapus"
                                                data-id="{{ $ac->id }}" data-nama="{{ $ac->nama_acara }}">Hapus</a>
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
                        <span class="text-muted">Halaman {{ $acara->currentPage() }} dari
                            {{ $acara->lastPage() }}</span>
                    </div>
                    <div>
                        <nav aria-label="Halaman">
                            <ul class="pagination justify-content-end mb-0">
                                @if ($acara->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $acara->previousPageUrl() }}">Sebelumnya</a>
                                    </li>
                                @endif

                                @foreach ($acara->getUrlRange(1, $acara->lastPage()) as $page => $url)
                                    @if ($page == $acara->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($acara->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $acara->nextPageUrl() }}">Selanjutnya</a>
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
    {{-- Hapus Data acara --}}
    <script>
        $('.hapus').click(function() {
            var acaraid = $(this).attr('data-id');
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
                        window.location = "/hhappuss/" + acaraid + ""
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
