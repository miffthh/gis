@extends('layout.template')

@section('container')
<div class="card">
    <div class="card-body mt-3">
        <h3>Halaman Data Budaya</h3>
        <hr>
        <h6>Data Budaya</h6>
    </div>
</div>
<div class="container">
    <a href="tambahbudayaadmin" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
    <!-- <a href="/expoortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
        <a href="/cetakkkform" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-in-up-right"></i> Export PDF Per Tgl
        </a>
        <a href="/expoortexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
            Excel</a>
        <a href="/bbbadm" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a> -->

    <!-- Filter Tanggal -->
    <!-- <div class="container col-lg-8 md-4 mt-3 row g-3">
        <form action="/periode" method="get" class="d-flex">
            <label for="tgl_mulai">From</label>
            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control datepicker">
            <label for="tgl_selesai" class="ms-2">To</label>
            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control datepicker">

            <button type="submit" name="filter_tgl" class="btn btn-success btn-sm datpicker ms-2"><i
                    class="bi bi-printer"></i> Filter</button>
        </form> -->
</div>
<!-- Filter Tanggal -->

<!-- Search Bar -->
<div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
    <div class="col-auto">
        <form class="search-form" action="/bbbadm" method="get">
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                    placeholder="Ketik nama perkiraan">
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
            <table class="table table">
                <thead class="table-info" id="records">
                    <tr align="center">
                        <th cscope="row"> No</th>
                        <th>Nama Budaya</th>
                        <th>Deskripsi Singkat</th>
                        <th>Alamat Budaya</th>
                        <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($budaya as $bu)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $bu->nama_budaya }}</td>
                        <td>{{ $bu->deskripsi_singkat }}</td>
                        <td>{{ $bu->alamat }}</td>
                        <td>
                            <a href="/editbudayaadmin/{{ $bu->id }}" type="button" class="btn btn-warning">Edit</a>
                            @if (auth()->user()->role == 'Admin')
                            <a href="#" type="button" class="btn btn-danger hapus" data-id="{{ $bu->id }}"  data-nama="{{ $bu->nama_budaya }}">Hapus</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('append-script')
    {{-- Hapus Data Penginapan --}}
    <script>
        $('.hapus').click(function() {
            var budayaid = $(this).attr('data-id');
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
                        window.location = "/hapussss/" + budayaid + ""
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
