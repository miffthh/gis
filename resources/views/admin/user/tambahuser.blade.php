@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data User</h3>
        <hr>

        <h6>Tambah Data User</h6>
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

            <form action="{{ 'tambahdatauser' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nip">NIP / NIK</label>
                    <input type="text" name="nip" class="form-control" id="nip" aria-describedby="emailHelp"
                        value="{{ old('nip') }}">
                </div>
                <div class="mb-3 mt-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="floatingInput">Email</label>
                    <input type="email" class="form-control" name="email" id="floatingInput"
                        placeholder="name@example.com" required>
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password"
                        required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="floatingInput">Level</label>
                    <select name="role" class="form-select" aria-label="Default select example" required>
                        <option>-- Pilih --</option>
                        <option value="Admin">Admin</option>
                        <option value="Wisata">Pemilik Wisata</option>
                        <option value="Penginapan">Pemilik Penginapan</option>
                        <option value="Resto">Pemilik Resto</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection
