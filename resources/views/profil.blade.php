@extends('layout.template')

@section('container')
    @if ($user)
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" class="rounded-circle">
                            <h2>{{ auth()->user()->name }}</h2>
                            <h3>{{ auth()->user()->role }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#profile-edit">Edit Profile</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->

                                    <form action="{{ route('edit_profil') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile"
                                                    id="profileImagePreview" class="rounded-circle"
                                                    style="max-width: 200px; max-height: 200px;">
                                                <input type="file" name="profile_image" id="profileImage"
                                                    class="form-control" onchange="previewProfileImage(this)">
                                                <small class="text-muted">Allowed file types: jpg, jpeg, png. Max file size:
                                                    2MB</small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nip" class="col-md-4 col-lg-3 col-form-label">NIP / NIK</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nip" type="text" class="form-control" id="nip"
                                                    value="{{ $user->nip }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="password" type="password" class="form-control" id="password">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()" id="showPasswordBtn"><i class="bi bi-eye"></i></button>
                                                </div>
                                            </div>
                                            <p class="small mb-0"><i>*Jika tidak ingin mengubah Password maka kosongkan saja.</i></p>
                                        </div>                                        

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                    <!-- End Profile Edit Form -->
                                </div>
                            </div>
                            <!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

<script>
    function previewProfileImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profileImagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordFieldType = passwordInput.getAttribute("type");

        // Toggle tipe input antara "password" dan "text"
        if (passwordFieldType === "password") {
            passwordInput.setAttribute("type", "text");
            document.getElementById("showPasswordBtn").innerText = "Hide Password";
        } else {
            passwordInput.setAttribute("type", "password");
            document.getElementById("showPasswordBtn").innerText = "Show Password";
        }
    }
</script>
