<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('template-admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Polikllinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template-admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @if (auth()->user()->role == 'dokter')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwalperiksa') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Jadwal Periksa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('memeriksapasien') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Memeriksa Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayatpasien') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Riwayat Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profil') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Profil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="/dokter/logout" method="POST">
                            @csrf
                            <button class="logout-style btn btn-danger" data-toggle="tooltip" data-placement="top"
                                title="Logout" type="submit">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @else
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dokter
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pasien') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('poli') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Poli
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('obat') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Obat
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="/admin/logout" method="POST">
                            @csrf
                            <button class="logout-style btn btn-danger" data-toggle="tooltip" data-placement="top"
                                title="Logout" type="submit">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @endif


    </div>
    <!-- /.sidebar -->
</aside>

{{-- <div class="sidebar-footer hidden-small logout-style2">
    <form action="/logout" method="POST">
    @csrf
        <button class="logout-style btn btn-danger" data-toggle="tooltip" data-placement="top" title="Logout" type="submit">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
        </button>
    </form>
</div> --}}
