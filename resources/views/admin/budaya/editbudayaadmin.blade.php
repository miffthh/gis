@extends('layout.template')

@section('container')
<div class="container">
    <h3>Halaman Tambah Data Budaya</h3>
    <hr>

    <h6>Tambah Data Budaya</h6>
</div>
<div class="card">
    <div class="card-body">
        @foreach ($budaya as $bu)
        <form action="/aksi_edit_budaya/{{ $bu->id }}"  method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="mt-3">Nama Budaya</label>
                <input type="text" name="nama_budaya" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $bu->nama_budaya }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="mt-3">Deskripsi Singkat</label>
                <input type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $bu->deskripsi_singkat }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="mt-3">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $bu->alamat }}">
            </div>
            <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Edit</button>
            <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
        </form>
        @endforeach
    </div>
</div>
@endsection

@push('append-script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
