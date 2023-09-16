<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>GIS | Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('NiceAdmin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        body {
            background-image: url('{{ asset('storage/bgsoreang.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo span {
            font-size: 20px;
            font-weight: 600;
            margin-left: 10px;
        }

        .nav-tabs {
            background-color: transparent;
            border: none;
            margin-top: 20px;
            border-bottom: 2px solid #ddd;
            padding: 0;
        }

        .nav-tabs .nav-link {
            border: none;
            background-color: transparent;
            padding: 10px 20px;
            color: #333;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 2px solid #007bff;
            color: #007bff;
        }

        .tab-content {
            padding: 20px 0;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 0;
        }

        .text-center {
            margin-top: 20px;
            color: #888;
        }

        .text-center strong {
            font-weight: 600;
        }

        .text-center a {
            color: #007bff;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Hide the password toggle button by default */
        #showPasswordToggle {
            display: none;
        }

        /* Show the password toggle button when the password input field is focused */
        .input-group:focus-within #showPasswordToggle {
            display: block;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <main>

        <div class="card mt-5">
            <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="">
                    <span class="d-none d-lg-block"><b>GIS PARIWISATA</b></span>
                </a>
            </div><!-- End Logo -->
            <div class="card-body">
                <h5 class="card-title">Form Register</h5>

                <!-- Default Tabs -->
                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Register Masyarakat</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Register Pemilik Wisata, Penginapan dan Resto</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabjustifiedContent">
                    <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                        aria-labelledby="home-tab">
                        <div>
                            <div>
                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Register to Your Account</h5>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>

                                <form action="{{ route('registeruser') }}" method="POST">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourNIP" class="form-label">NIK</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="nip" class="form-control" id="yourNIP"
                                                required autofocus>
                                            <div class="invalid-feedback">Please enter your nip.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="yourName" class="form-label">Name</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="yourEmail" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="email" class="form-control" id="yourEmail"
                                                required>
                                            <div class="invalid-feedback">Please enter your email.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="showPasswordToggle"><i class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary w-100" type="submit">Register</button>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <p class="small mb-0">Sudah punya akun? <a href="login">Login</a>
                                        </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="mb-3">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Register to Your Account</h5>
                                <p class="text-center small">Enter your email & password to login</p>
                            </div>

                            <form action="{{ route('registeradmin') }}" method="POST">
                                @csrf

                                <div class="col-12">
                                    <label for="yourNIP" class="form-label">NIK</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="nip" class="form-control" id="yourNIP"
                                            required autofocus>
                                        <div class="invalid-feedback">Please enter your nip.</div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="yourName" class="form-label">Name</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="name" class="form-control" id="yourName"
                                            required>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="yourEmail" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="email" class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Please enter your email.</div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                            id="yourPasswordd" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="showPasswordTogglee"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                <div class="mb-3 mt-2">
                                    <label for="floatingInput">Level</label>
                                    <select name="role" class="form-select" aria-label="Default select example"
                                        required>
                                        <option>-- Pilih --</option>
                                        <option value="Wisata">Pemilik Wisata</option>
                                        <option value="Penginapan">Pemilik Penginapan</option>
                                        <option value="Resto">Pemilik Resto</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="latitude">Latitude</label>
                                    <input id="latitude" type="text"
                                        class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                        value="{{ old('latitude') }}">
                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="longitude">Longitude</label>
                                    <input id="longitude" type="text"
                                        class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                        value="{{ old('longitude') }}">
                                    @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
                                </div>
                                <div class="col-12 mt-2">
                                    <p class="small mb-0">Sudah punya akun? <a href="login">Login</a>
                                    </p>
                                </div>
                            </form>


                        </div>
                    </div>
                </div><!-- End Default Tabs -->


            </div>
            <div class="text-center small">
                &copy; <strong>DISBUDPAR Kabupaten Bandung</strong>. All Rights Reserved
            </div>
        </div>

    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JSFile -->
    <script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>

    <script>
        document.getElementById('showPasswordToggle').addEventListener('click', function() {
            var passwordInput = document.getElementById('yourPassword');
            var passwordType = passwordInput.getAttribute('type');

            if (passwordType === 'password') {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        });

        document.getElementById('showPasswordTogglee').addEventListener('click', function() {
            var passwordInput = document.getElementById('yourPasswordd');
            var passwordType = passwordInput.getAttribute('type');

            if (passwordType === 'password') {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        });
    </script>

</body>

</html>
