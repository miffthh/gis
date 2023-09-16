@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data Acara</h3>
        <hr>

        <h6>Edit Data Acara</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach ($acara as $ac)
                <form action="/aksi_edit_acara/{{ $ac->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="oldPhoto" value="{{ $ac->photo }}">
                    <div class="mb-3 mt-3">
                        <label for="nama_acara">Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" id="nama_acara"
                            aria-describedby="emailHelp" value="{{ $ac->nama_acara }}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="kategori">Kategori Acara</label>
                        <input type="text" name="kategori" class="form-control" id="kategori"
                            aria-describedby="emailHelp" value="{{ $ac->kategori }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Deskripsi Singkat</label>
                        <textarea type="text" name="deskripsi_singkat" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" rows="7">{{ $ac->deskripsi_singkat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $ac->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Hadiah</label>
                        <textarea type="text" name="hadiah" class="form-control" rows="5" id="exampleInputEmail1"
                            aria-describedby="emailHelp">{{$ac->hadiah}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $ac->kontak }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" rows="5" id="alamat"
                            aria-describedby="emailHelp">{{ $ac->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                            name="latitude" value="{{ $ac->latitude }}" required>
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
                            value="{{ $ac->longitude }}" required>
                        @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo">
                        <img src="{{ asset('storage/photo_acara/' . $ac->photo) }}" id="img-view" width="100px"
                            class="mt-3">
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                    <a type="button" href="/baatal" class="btn btn-info mt-3">Batal</a>
                </form>
            @endforeach
        </div>
    </div>
@endsection

@push('append-script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
