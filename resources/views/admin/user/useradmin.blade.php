@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman User</h3>
            <hr>
            <h6>Data User</h6>
        </div>
    </div>

    <div class="container">
        <a href="tambahuser" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        {{-- <a href="/expoortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
        <a href="/cetakkkform" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-in-up-right"></i> Export PDF Per Tgl
        </a>
        <a href="/expoortexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
            Excel</a> --}}
        <a href="/useradmin" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>
    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/useradmin" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama User">
                </div>
            </form>
        </div>
    </div>


    <!-- End Search -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-info">
                        <tr align="center">
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($user as $index => $row)
                            <tr>
                                <td scope="row">{{ $index + $user->firstItem() }}</td>
                                <td>{{ $row->nip }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->role }}</td>
                                <td>{{ $row->latitude }}</td>
                                <td>{{ $row->longitude }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('tampilkandatauser/' . $row->id) }}"
                                            class="btn btn-info btn-sm mx-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('send-verification-email', ['user' => $row->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm mx-1">
                                                <i class="ri-mail-check-line"></i> Verifikasi
                                            </button>
                                        </form>
                                        <form action="{{ route('send-verification-emaill', ['user' => $row->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm mx-1">
                                                <i class="ri-mail-close-line"></i> Reject
                                            </button>
                                        </form>                                        
                                        <a href="#" type="button" class="btn btn-danger btn-sm hapus mx-1"
                                            data-id="{{ $row->id }}" data-nama="{{ $row->name }}"><i
                                                class="ri-delete-bin-4-line"></i> Hapus</a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginasi -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="text-muted">Halaman {{ $user->currentPage() }} dari
                        {{ $user->lastPage() }}</span>
                </div>
                <div>
                    <nav aria-label="Halaman">
                        <ul class="pagination justify-content-end mb-0">
                            @if ($user->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $user->previousPageUrl() }}">Sebelumnya</a>
                                </li>
                            @endif

                            @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                                @if ($page == $user->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($user->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $user->nextPageUrl() }}">Selanjutnya</a>
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
            <!-- End Paginasi -->
        </div>
    </div>
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data User --}}
    <script>
        $('.hapus').click(function() {
            var userid = $(this).attr('data-id');
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
                        window.location = "/happussss/" + userid + ""
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
