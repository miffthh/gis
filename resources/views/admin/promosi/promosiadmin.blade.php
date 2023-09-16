@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Promosi</h3>
            <hr>
            <h6>Data Promosi</h6>
        </div>
    </div>
    <div class="container">
        <a href="tambahpromosiadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'Admin')
            <a href="/eeksportpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/ekksportexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/promosiadmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/promosiadmin" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Promosi">
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
                                <th cscope="row">No</th>
                                <th>Nama Promosi</th>
                                <th>Deskripsi Singkat</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Harga Awal</th>
                                <th>Harga Promo</th>
                                <th>Syarat &amp; Ketentuan</th>
                                <th>latitude</th>
                                <th>longitude</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($promosi as $index => $pr)
                                <tr>
                                    <td scope="row">{{ $index + $promosi->firstItem() }}</td>
                                    <td>{{ $pr->nama_promosi }}</td>
                                    <td>{!! nl2br($pr->deskripsi_singkat) !!}</td>
                                    <td>{{ $pr->tgl_awal }}</td>
                                    <td>{{ $pr->tgl_akhir }}</td>
                                    <td>{{ $pr->harga_awal }}</td>
                                    <td>{{ $pr->harga_promo }}</td>
                                    <td>{!! $pr->sk !!}</td>
                                    <td>{{ $pr->latitude }}</td>
                                    <td>{{ $pr->longitude }}</td>
                                    <td>
                                        <img src="{{ asset('storage/photo_promosi/' . $pr->photo) }}" width="70%">
                                    </td>
                                    <td>
                                        <a href="/editpromosiadmin/{{ $pr->id }}" type="button"
                                            class="btn btn-warning">Edit</a>
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="#" type="button" class="btn btn-danger hapus"
                                                data-id="{{ $pr->id }}" data-nama="{{ $pr->nama_promosi }}">Hapus</a>
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
                        <span class="text-muted">Halaman {{ $promosi->currentPage() }} dari
                            {{ $promosi->lastPage() }}</span>
                    </div>
                    <div>
                        <nav aria-label="Halaman">
                            <ul class="pagination justify-content-end mb-0">
                                @if ($promosi->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promosi->previousPageUrl() }}">Sebelumnya</a>
                                    </li>
                                @endif

                                @foreach ($promosi->getUrlRange(1, $promosi->lastPage()) as $page => $url)
                                    @if ($page == $promosi->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($promosi->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promosi->nextPageUrl() }}">Selanjutnya</a>
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
            </div>
        </div>
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data promosi --}}
    <script>
        $('.hapus').click(function() {
            var promosiid = $(this).attr('data-id');
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
                        window.location = "/hhapuss/" + promosiid + ""
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
