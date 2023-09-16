@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Promosi</h3>
        <hr>

        <h6>Tambah Data Promosi</h6>
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

            <form action="{{ 'aksi_tambah_promosi' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nama_promosi">Nama Promosi</label>
                    <input type="text" name="nama_promosi" class="form-control" id="nama_promosi"
                        aria-describedby="emailHelp" value="{{ old('nama_promosi') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Deskripsi Singkat</label>
                    <textarea type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('deskripsi_singkat') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Dari Tanggal</label>
                    <input type="date" name="tgl_awal" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('tgl_awal') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Sampai Tanggal</label>
                    <input type="date" name="tgl_akhir" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('tgl_akhir') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Harga Awal</label>
                    <input type="text" name="harga_awal" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('harga_awal') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Harga Promo</label>
                    <input type="text" name="harga_promo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="{{ old('harga_promo') }}">
                </div>
                <div class="mb-3">
                    <label for="sk">Syarat & Ketentuan</label>
                    <textarea type="text" name="sk" class="form-control" rows="5" id="sk" aria-describedby="emailHelp"
                        value="{{ old('sk') }}"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="latitude">Latitude</label>
                    <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                        name="latitude" value="{{ old('latitude') }}" required>
                    @error('latitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="longitude">Longitude</label>
                    <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror"
                        name="longitude" value="{{ old('longitude') }}" required>
                    @error('longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control" id="photo">
                    <img src="" id="img-view" width="100px" class="mt-3">
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/baatal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('append-script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/customP.js') }}"></script>
@endpush
