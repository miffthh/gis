@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data Resto</h3>
        <hr>

        <h6>Edit Data Resto</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach ($resto as $dr)
                <form action="/aksi_edit_resto/{{ $dr->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="oldPhoto1" value="{{ $dr->photo1 }}">
                    <input type="hidden" name="oldPhoto2" value="{{ $dr->photo2 }}">
                    <input type="hidden" name="oldPhoto3" value="{{ $dr->photo3 }}">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Nama Resto</label>
                        <input type="text" name="nama_resto" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dr->nama_resto }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label type="text" id="kategori_resto" class="mt-3">Kategori</label>
                        </div>
                        <div class="form-group">
                            <select name="kategori_resto" class="form-select" aria-label="Default select example" required>
                                <option selected>{{ $dr->kategori_resto }}</option>
                                <option value="Cafe">Cafe</option>
                                <option value="Rumah Makan">Rumah Makan</option>
                                <option value="Restoran">Restoran</option>
                                <option value="Pusat Oleh-Oleh">Pusat Oleh-Oleh</option>
                                <option value="Katering">Katering</option>
                                <option value="Bar">Bar</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Deskripsi Singkat</label>
                        <textarea type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" rows="7">{{ $dr->deskripsi_singkat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Jam Operasional</label>
                        <textarea type="text" name="jam_operasional" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" rows="3">{{ $dr->jam_operasional }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dr->kontak }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="mt-3">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" rows="5" id="alamat" aria-describedby="emailHelp">{{ $dr->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                            name="latitude" value="{{ $dr->latitude }}" required>
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
                            value="{{ $dr->longitude }}" required>
                        @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo1">Gambar 1</label>
                        <input type="file" name="photo1" class="form-control" id="photo1">

                        <img src="{{ asset('storage/photo_resto/' . $dr->photo1) }}" id="img-view" width="100px"
                            class="mt-3">
                    </div>
                    <div class="mb-3">
                        <label for="photo2">Gambar 2</label>
                        <input type="file" name="photo2" class="form-control" id="photo2">

                        <img src="{{ asset('storage/photo_resto/' . $dr->photo2) }}" id="img-view2" width="100px"
                            class="mt-3">
                    </div>
                    <div class="mb-3">
                        <label for="photo3">Gambar 3</label>
                        <input type="file" name="photo3" class="form-control" id="photo3">

                        <img src="{{ asset('storage/photo_resto/' . $dr->photo3) }}" id="img-view3" width="100px"
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
