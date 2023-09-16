<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard -->

        <li class="nav-heading">Pages</li>

        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="/" target="_blank">
                <i class="ri-home-3-line"></i>
                <span>Go to Home</span>
            </a>
        </li>
        <!-- End Home -->

        @if (auth()->check())
            <!-- Data User (Admin Only) -->
            @if (auth()->user()->role == 'Admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('useradmin') ? '' : 'collapsed' }}" href="/useradmin">
                        <i class="ri-file-user-line"></i>
                        <span>Data User</span>
                    </a>
                </li>
            @endif
            <!-- End Data User -->

            <!-- Data Wisata -->
            @if (auth()->check() && (auth()->user()->role == 'Admin' || auth()->user()->role == 'Wisata'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('wisataadmin') ? '' : 'collapsed' }}" href="/wisataadmin">
                        <i class="ri-ancient-gate-line"></i>
                        <span>Data Wisata</span>
                    </a>
                </li>
            @endif
            <!-- End Data Wisata -->


            <!-- Data Penginapan -->
            @if (in_array(auth()->user()->role, ['Admin', 'Penginapan']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('penginapanadmin') ? '' : 'collapsed' }}"
                        href="/penginapanadmin">
                        <i class="ri-hotel-line"></i>
                        <span>Data Penginapan</span>
                    </a>
                </li>
            @endif
            <!-- End Data Penginapan -->

            <!-- Data Resto -->
            @if (in_array(auth()->user()->role, ['Admin', 'Resto']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('restoadmin') ? '' : 'collapsed' }}" href="/restoadmin">
                        <i class="ri-restaurant-line"></i>
                        <span>Data Resto & Cafe</span>
                    </a>
                </li>
            @endif
            <!-- End Data Resto -->

            <!-- Data Acara -->
            @if (in_array(auth()->user()->role, ['Admin', 'Wisata', 'Penginapan', 'Resto']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('acaraadmin') ? '' : 'collapsed' }}" href="/acaraadmin">
                        <i class="ri-calendar-todo-fill"></i>
                        <span>Data Acara</span>
                    </a>
                </li>
            @endif

            <!-- Data Promosi -->
            @if (in_array(auth()->user()->role, ['Admin', 'Wisata', 'Penginapan', 'Resto']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('promosiadmin') ? '' : 'collapsed' }}" href="/promosiadmin">
                        <i class="ri-coins-line"></i>
                        <span>Data Promosi</span>
                    </a>
                </li>
            @endif

            <!-- Data Forum -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('forum') ? '' : 'collapsed' }}" href="/forum">
                    <i class="ri-coins-line"></i>
                    <span>Data Forum</span>
                </a>
            </li>
            <!-- End Data Forum -->
        @endif
    </ul>
</aside>
<!-- End Sidebar -->
