@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data Wisata</h3>
        <hr>

        <h6>Edit Data Wisata</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach ($wisata as $dw)
                <form action="/aksi_edit_wisata/{{ $dw->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="oldPhoto1" value="{{ $dw->photo1 }}">
                    <input type="hidden" name="oldPhoto2" value="{{ $dw->photo2 }}">
                    <input type="hidden" name="oldPhoto3" value="{{ $dw->photo3 }}">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Nama Wisata</label>
                        <input type="text" name="nama_wisata" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->nama_wisata }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label type="text" id="kategori" class="mt-3">Kategori Wisata</label>
                        </div>
                        <div class="form-group">
                            <select name="kategori" class="form-select" aria-label="Default select example" required>
                                <option selected>{{ $dw->kategori }}</option>
                                <option value="Wisata Alam">Wisata Alam</option>
                                <option value="Wisata Rekreasi">Wisata Rekreasi</option>
                                <option value="Wisata Religi">Wisata Religi</option>
                                <option value="Desa Wisata">Desa Wisata</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Deskripsi Singkat</label>
                        <input type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->deskripsi_singkat }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Harga Tiket</label>
                        <input type="text" name="harga_tiket" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->harga_tiket }}">
                    </div>

                    <div>
                        <label for="exampleInputEmail1">Akses Kendaraan</label>
                        <div class="mb-3 form-control container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Dua"
                                    id="flexCheckDefault"
                                    {{ in_array('Roda Dua', explode(PHP_EOL, $dw->akses_kendaraan)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Roda Dua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Empat"
                                    id="flexCheckChecked"
                                    {{ in_array('Roda Empat', explode(PHP_EOL, $dw->akses_kendaraan)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Roda Empat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="akses_kendaraan[]" value="Roda Enam"
                                    id="flexCheckChecked"
                                    {{ in_array('Roda Enam', explode(PHP_EOL, $dw->akses_kendaraan)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Roda Enam
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Jam Operasional</label>
                        <input type="text" name="jam_operasional" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->jam_operasional }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Website</label>
                        <input type="text" name="website" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->website }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->kontak }}">
                    </div>
                    <div>
                        <label for="exampleInputEmail1">Fasilitas</label>
                        <div class="mb-3 form-control container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Toilet"
                                            id="flexCheckDefault"{{ in_array('Toilet', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Toilet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Mushola" id="flexCheckChecked"
                                            id="flexCheckDefault"{{ in_array('Mushola', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Mushola
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Food Court" id="flexCheckChecked"
                                            id="flexCheckDefault"{{ in_array('Food Court', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Food Court
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Tempat Parkir" id="flexCheckDefault"
                                            id="flexCheckDefault"{{ in_array('Tempat Parkir', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tempat Parkir
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Tempat Istirahat" id="flexCheckChecked"
                                            id="flexCheckDefault"{{ in_array('Tempat Istirahat', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Tempat Istirahat
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Tempat Sampah" id="flexCheckChecked"
                                            {{ in_array('Tempat Sampah', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Tempat Sampah
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Pusat Informasi" id="flexCheckDefault"
                                            {{ in_array('Pusat Informasi', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Pusat Informasi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Papan Petunjuk" id="flexCheckChecked"
                                            {{ in_array('Papan Petunjuk', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Papan Petunjuk
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Keamanan / CCTV" id="flexCheckChecked"
                                            {{ in_array('Keamanan / CCTV', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Keamanan / CCTV
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Aksessibilitas" id="flexCheckChecked"
                                            {{ in_array('Aksessibilitas', explode(PHP_EOL, $dw->fasilitas)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Aksessibilitas
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" rows="5" id="exampleInputEmail1"
                            aria-describedby="emailHelp">{{ $dw->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                            name="latitude" value="{{ $dw->latitude }}" required>
                        @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input id="longitude" type="text"
                            class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                            value="{{ $dw->longitude }}" required>
                        @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo1">Gambar 1</label>
                        <input type="file" name="photo1" class="form-control" id="photo1">

                        <img src="{{ asset('storage/photo_wisata/' . $dw->photo1) }}" id="img-view" width="100px"
                            class="mt-3">
                    </div>
                    <div class="mb-3">
                        <label for="photo2">Gambar 2</label>
                        <input type="file" name="photo2" class="form-control" id="photo2">

                        <img src="{{ asset('storage/photo_wisata/' . $dw->photo2) }}" id="img-view2" width="100px"
                            class="mt-3">
                    </div>
                    <div class="mb-3">
                        <label for="photo3">Gambar 3</label>
                        <input type="file" name="photo3" class="form-control" id="photo3">

                        <img src="{{ asset('storage/photo_wisata/' . $dw->photo3) }}" id="img-view3" width="100px"
                            class="mt-3">
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Edit</button>
                    <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
                </form>
            @endforeach
        </div>
    </div>
@endsection

@push('append-script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom1.js') }}"></script>
    <script src="{{ asset('assets/js/custom-1.js') }}"></script>
@endpush
