@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Resto</h3>
        <hr>

        <h6>Tambah Data Resto</h6>
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

            <form action="{{ 'aksi_tambah_resto' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nama_resto">Nama Resto</label>
                    <input type="text" name="nama_resto" class="form-control" id="nama_resto"
                        aria-describedby="emailHelp" value="{{ old('nama_resto') }}">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label type="text" id="kategori_resto">Kategori Resto</label>
                    </div>
                    <div class="form-group">
                        <select name="kategori_resto" class="form-select" aria-label="Default select example" required>
                            <option selected>-- Pilih --</option>
                            <option value="Cafe">Caffee</option>
                            <option value="Rumah Makan">Rumah Makan</option>
                            <option value="Restoran">Restoran</option>
                            <option value="Pusat Oleh-Oleh">Pusat Oleh-Oleh</option>
                            <option value="Katering">Katering</option>
                            <option value="Bar">Bar</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Deskripsi Singkat</label>
                    <textarea type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('deskripsi_singkat') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Jam Operasional</label>
                    <textarea type="text" name="jam_operasional" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="3" value="{{ old('jam_operasional') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Kontak</label>
                    <input type="text" name="kontak" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('kontak') }}">
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" name="alamat" class="form-control" rows="5" id="alamat" aria-describedby="emailHelp"
                        value="{{ old('alamat') }}"></textarea>
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
                    <label for="photo1">Gambar 1</label>
                    <input type="file" name="photo1" class="form-control" id="photo1">
                    <img src="" id="img-view" width="100px" class="mt-3">
                </div>
                <div class="mb-3">
                    <label for="photo2">Gambar 2</label>
                    <input type="file" name="photo2" class="form-control" id="photo2">
                    <img src="" id="img-view2" width="100px" class="mt-3">
                </div>
                <div class="mb-3">
                    <label for="photo3">Gambar 3</label>
                    <input type="file" name="photo3" class="form-control" id="photo3">
                    <img src="" id="img-view3" width="100px" class="mt-3">
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/bataal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('append-script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom1.js') }}"></script>
<script src="{{ asset('assets/js/custom-1.js') }}"></script>
@endpush
