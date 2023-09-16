@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Budaya</h3>
        <hr>

        <h6>Tambah Data Budaya</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ 'aksi_tambah_budaya' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nama_budaya">Nama Budaya</label>
                    <input type="text" name="nama_budaya" class="form-control" id="nama_budaya"
                        aria-describedby="emailHelp" value="{{ old('nama_budaya') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('deskripsi_singkat') }}">
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" name="alamat" class="form-control" id="alamat" aria-describedby="emailHelp"
                        value="{{ old('alamat') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection
