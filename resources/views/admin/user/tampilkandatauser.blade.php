@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data User</h3>
        <hr>

        <h6>Edit Data User</h6>
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

            {{-- @foreach ($user as $user) --}}
                <form action="/updatedatauser/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nip" aria-describedby="emailHelp"
                            value="{{ old('nip', $user->nip) }}" readonly>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            aria-describedby="emailHelp" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="floatingInput">Email</label>
                        <input type="email" class="form-control" name="email" id="floatingInput"
                            placeholder="name@example.com" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" name="password" id="floatingPassword"
                            placeholder="Password" value="{{ old('password', $user->password) }}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="floatingInput">Level</label>
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option>{{ old('role', $user->role) }}</option>
                            <option value="Admin">Admin</option>
                            <option value="Wisata">Wisata</option>
                            <option value="Penginapan">Penginapan</option>
                            <option value="Resto">Resto</option>
                            <option value="Umum">Umum</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Update</button>
                    <a type="button" href="/useradmin" class="btn btn-info mt-3">Batal</a>
                </form>
            {{-- @endforeach --}}
        </div>
    </div>
@endsection
