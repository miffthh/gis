@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Wisata</h3>
        <hr>

        <h6>Tambah Data Wisata</h6>
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

            <form action="{{ 'aksi_tambah_wisata' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nama_wisata">Nama Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" id="nama_wisata"
                        aria-describedby="emailHelp" value="{{ old('nama_wisata') }}" autofocus>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label type="text" id="kategori">Kategori Wisata</label>
                    </div>
                    <div class="form-group">
                        <select name="kategori" class="form-select" aria-label="Default select example" required>
                            <option selected>-- Pilih --</option>
                            <option value="Wisata Alam">Wisata Alam</option>
                            <option value="Wisata Rekreasi">Wisata Rekreasi</option>
                            <option value="Wisata Religi">Wisata Religi</option>
                            <option value="Desa Wisata">Desa Wisata</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1">Deskripsi Singkat</label>
                    <textarea type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('deskripsi_singkat') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Harga Tiket</label>
                    <textarea type="text" name="harga_tiket" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="3" value="{{ old('harga_tiket') }}"></textarea>
                </div>

                <div>
                    <label for="exampleInputEmail1">Akses Kendaraan</label>
                    <div class="mb-3 form-control container">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Dua"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Roda Dua
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Empat"
                                id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Roda Empat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Enam"
                                id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Roda Enam
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Jam Operasional</label>
                    <textarea type="text" name="jam_operasional" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="2" value="{{ old('jam_operasional') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Website</label>
                    <input type="text" name="website" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('website') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Kontak</label>
                    <input type="text" name="kontak" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('kontak') }}">
                </div>
                <div>
                    <label for="exampleInputEmail1">Fasilitas</label>
                    <div class="mb-3 form-control container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Toilet"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Toilet
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Mushola"
                                        id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Mushola
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Food Court" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Food Court
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Tempat Parkir" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tempat Parkir
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Tempat Istirahat" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Tempat Istirahat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Tempat Sampah" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Tempat Sampah
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Pusat Informasi" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Pusat Informasi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Papan Petunjuk" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Papan Petunjuk
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Keamanan / CCTV" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Keamanan / CCTV
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                        value="Aksessibilitas" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Aksessibilitas
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" name="alamat" class="form-control" rows="5" id="alamat"
                        aria-describedby="emailHelp" value="{{ old('alamat') }}"></textarea>
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
                <a type="button" href="/cancel" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('append-script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom1.js') }}"></script>
    <script src="{{ asset('assets/js/custom-1.js') }}"></script>
@endpush
