<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Bootstrap</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.16.0/font/bootstrap-icons.css">
    <style>
        /* Custom CSS */
        .navbar {
            background-color: #008ca5;
            /* Blue background color for the navbar */
        }

        .navbar-brand {
            color: #ffffff;
            /* White color for the navbar text */
            font-size: 28px;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            /* White color for the navbar links */
        }

        .user-profile,
        .user-profile a {
            color: white;
            /* White color for the user profile text */
        }

        .dropdown-menu {
            background-color: #000000;
            /* Black background for the dropdown menu */
        }

        .dropdown-menu a {
            color: #333 !important;
            /* White color for the dropdown menu items */
        }

        .dropdown-menu a:hover {
            background-color: #007bff;
            /* Hover color for dropdown menu items */
        }
    </style>
</head>

<body>

    <header
        class="navbar navbar-expand-lg navbar-blue d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
        <div class="container">
            <div class="col-md-3 col-6 mb-md-0">
                <div class="logo">
                    <a href="/"
                        class="d-inline-flex link-body-emphasis text-decoration-none navbar-brand text-light">
                        <h3><b>GIS Pariwisata</b></h3>
                    </a>
                </div>
            </div>

            <div class="col-md-auto col-6 mb-2 justify-content-center mb-md-0">
                <ul class="navbar-nav">
                    <!-- Your navigation links here -->
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('wisata') ? 'active' : '' }}"
                            href="/wisata">Wisata</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('penginapan') ? 'active' : '' }}"
                            href="/penginapan">Penginapan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('resto') ? 'active' : '' }}"
                            href="/resto">Resto & Cafe</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('event') ? 'active' : '' }}"
                            href="/event">Acara</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('promosi') ? 'active' : '' }}"
                            href="/promosi">Promosi</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('forum') ? 'active' : '' }}"
                            href="/forum">Forum</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-12">
                <div class="user-profile">
                    <!-- Your user profile section here -->
                    @guest
                        <a class="getstarted scrollto" href="/login">Login</a>
                    @else
                        @php
                            $user = auth()->user();
                        @endphp
                        <!-- Tampilkan menu profil hanya untuk pengguna yang telah login -->
                        @auth
                            <div class="nav-item dropdown">
                                @if ($user->profile_image)
                                    <!-- Check if user has no profile image -->
                                    <a class="nav-link nav-profile d-flex align-items-center" href="#"
                                        id="profileDropdownTrigger" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile"
                                            class="rounded-circle ms-5" style="width: 60px; height: 60px;">
                                        <span class="mr-2" style="font-size: 16px;">{{ auth()->user()->name }}</span>
                                    </a>
                                @else
                                <a class="nav-link nav-profile d-flex align-items-center" href="#"
                                id="profileDropdownTrigger" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('storage/profile_images/default/user.png') }}" alt="Profile"
                                    class="rounded-circle ms-5" style="width: 60px; height: 60px;">
                                <span class="mr-2" style="font-size: 16px;">{{ auth()->user()->name }}</span>
                            </a>
                                @endif
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdownTrigger">
                                    <li class="dropdown-header">
                                        @if (auth()->check())
                                            <h6 class="center">{{ $user->name }}</h6>
                                            <span class="center">{{ $user->role }}</span>
                                        @endif
                                    </li>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" href="/profil">
                                        <i class="bi bi-person ms-1"></i> <span class="mr-4">My Profile</span>
                                    </a>
                                    <a class="dropdown-item" href="/dashboard">
                                        <i class="bi bi-speedometer ms-1"></i> <span class="mr-4">Dashboard</span>
                                    </a>
                                    <a class="dropdown-item" href="/logout">
                                        <i class="bi bi-box-arrow-right ms-1"></i> <span class="mr-4">Logout</span>
                                    </a>
                                    <style>
                                        .dropdown-menu {
                                            background-color: white;
                                            /* White background for the dropdown menu */
                                            border: none;
                                            /* Remove border */
                                            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
                                            /* Add shadow */
                                            border-radius: 8px;
                                            /* Rounded corners */
                                        }

                                        .dropdown-item {
                                            color: #f0f0f0;
                                            /* Semi-black color for the dropdown items */
                                            transition: background-color 0.3s;
                                            /* Smooth hover transition */
                                            display: flex;
                                            align-items: center;
                                        }

                                        .dropdown-item:hover {
                                            background-color: #f0f0f0;
                                            /* Hover background color for dropdown items */
                                        }

                                        .dropdown-item i {
                                            width: 20px;
                                            /* Set width for the icon */
                                        }
                                    </style>
                                </div>

                                <style>
                                    .dropdown-menu {
                                        background-color: white;
                                        /* White background for the dropdown menu */
                                        color: #f0f0f0;
                                        /* Semi-black color for the dropdown menu text */
                                    }

                                    .dropdown-item {
                                        color: #333 !important;
                                        /* Semi-black color for the dropdown items */
                                    }

                                    .dropdown-item:hover {
                                        background-color: #f0f0f0;
                                        /* Hover background color for dropdown items */
                                    }
                                </style>
                            </div>

                        @endauth
                    @endguest
                </div>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list mobile-nav-toggle"></i>
        </button>
    </header>

    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
