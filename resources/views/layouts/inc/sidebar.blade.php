<!-- Main Sidebar Container -->
@php
    use App\Models\Ekstrakurikuler;

    $user = Auth::user();

    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    $siswa = Auth::user()->siswa;

@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light d-xs-none text-uppercase">{{ auth()->user()->role }}
        </span>
        <span class="brand-text font-weight-light d-sm-none">eRaport - <span style="text-transform: uppercase">{{ auth()->user()->role }}</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item mt-1">
                    <a href="{{ '/' . $user->role . '/dashboard' }}"
                        class="nav-link {{ Request::is($user->role . '/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                    @can('admin')

                        <li class="nav-header fw-bold mt-2">MASTER DATA</li>

                        <li class="nav-item
                            {{ Request::is($user->role . '/datasiswa*') |
                            Request::is($user->role . '/dataguru*') |
                            Request::is($user->role . '/dataakun*')
                                ? 'menu-open'
                                : '' }}">

                            <a href="#" class="nav-link
                                {{ Request::is($user->role . '/datasiswa*') |
                                Request::is($user->role . '/dataguru*') |
                                Request::is($user->role . '/dataakun*')
                                    ? 'active'
                                    : '' }}">

                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    BIODATA
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                {{-- @can('admin') --}}
                                    <li class="nav-item">
                                        <a href="{{ '/' . $user->role . '/datasiswa' }}"
                                            class="nav-link {{ Request::is($user->role . '/datasiswa*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Siswa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ '/' . $user->role . '/dataguru' }}"
                                            class="nav-link {{ Request::is($user->role . '/dataguru*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Guru</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ '/' . $user->role . '/dataakun' }}"
                                            class="nav-link {{ Request::is($user->role . '/dataakun*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Akun </p>
                                        </a>
                                    </li>
                                {{-- @endcan --}}
                            </ul>
                        </li>

                        <li class="nav-item
                            {{ Request::is($user->role . '/datasekolah*') |
                            Request::is($user->role . '/datakelas*') |
                            Request::is($user->role . '/datamapel*') |
                            Request::is($user->role . '/datatapel*')
                                ? 'menu-open'
                                : '' }} ">

                            <a href="#" class="nav-link
                                {{ Request::is($user->role . '/datasekolah*') |
                                Request::is($user->role . '/datakelas*') |
                                Request::is($user->role . '/datamapel*') |
                                Request::is($user->role . '/datatapel*')
                                    ? 'active'
                                    : '' }} ">

                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    ADMINISTRASI
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datasekolah' }}"
                                        class="nav-link {{ Request::is($user->role . '/datasekolah*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Sekolah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datatapel' }}"
                                        class="nav-link {{ Request::is($user->role . '/datatapel*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Tahun Pelajaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datakelas' }}"
                                        class="nav-link {{ Request::is($user->role . '/datakelas*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datamapel' }}"
                                        class="nav-link {{ Request::is($user->role . '/datamapel*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Mapel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item
                            {{ Request::is($user->role . '/datapembelajaran*') |
                            Request::is($user->role . '/nilaisosial*') |
                            Request::is($user->role . '/nilaispiritual*') |
                            Request::is($user->role . '/kehadiran*') |
                            Request::is($user->role . '/catatan*') |
                            Request::is($user->role . '/dataekstrakurikuler*') |
                            Request::is($user->role . '/dataprestasi*')
                                ? 'menu-open'
                                : '' }} ">
                            <a href="#" class="nav-link
                                {{ Request::is($user->role . '/datapembelajaran*') |
                                Request::is($user->role . '/nilaisosial*') |
                                Request::is($user->role . '/nilaispiritual*') |
                                Request::is($user->role . '/kehadiran*') |
                                Request::is($user->role . '/catatan*') |
                                Request::is($user->role . '/dataekstrakurikuler*') |
                                Request::is($user->role . '/dataprestasi*')
                                    ? 'active'
                                    : '' }} ">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    PENILAIAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datapembelajaran' }}"
                                        class="nav-link {{ Request::is($user->role . '/datapembelajaran*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pembelajaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/nilaisosial' }}"
                                        class="nav-link {{ Request::is($user->role . '/nilaisosial*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nilai Sosial</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/nilaispiritual' }}"
                                        class="nav-link {{ Request::is($user->role . '/nilaispiritual*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nilai Spiritual</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/kehadiran' }}"
                                        class="nav-link {{ Request::is($user->role . '/kehadiran*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ketidakhadiran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/catatan' }}"
                                        class="nav-link {{ Request::is($user->role . '/catatan*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Catatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/dataekstrakurikuler' }}"
                                        class="nav-link {{ Request::is($user->role . '/dataekstrakurikuler*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ekstrakurikuler</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/dataprestasi' }}"
                                        class="nav-link {{ Request::is($user->role . '/dataprestasi*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Prestasi</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                @endif


                {{-- WALI KELAS --}}
                @if (Auth::user()->role == 'guru')
                    @if ($guru->kelas)
                        <li class="nav-header fw-bold mt-2">MASTER DATA</li>
                        
                        <li class="nav-item
                            {{ Request::is('guru/datasiswa*') ? 'menu-open' : '' }}">

                            <a href="#" class="nav-link
                                {{ Request::is('guru/datasiswa*') ? 'active' : '' }}">

                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    BIODATA
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ '/guru/datasiswa/'. $guru->kelas->id }}"
                                        class="nav-link {{ Request::is('guru/datasiswa*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item
                            {{ Request::is($user->role . '/datakelas*') |
                            Request::is($user->role . '/nilaisosial*') |
                            Request::is($user->role . '/nilaispiritual*') |
                            Request::is($user->role . '/kehadiran*') |
                            Request::is($user->role . '/catatan*') |
                            Request::is($user->role . '/dataprestasi*')
                                ? 'menu-open'
                                : '' }} ">

                            <a href="#" class="nav-link
                                {{ Request::is($user->role . '/datakelas*') |
                                Request::is($user->role . '/nilaisosial*') |
                                Request::is($user->role . '/nilaispiritual*') |
                                Request::is($user->role . '/kehadiran*') |
                                Request::is($user->role . '/catatan*') |
                                Request::is($user->role . '/dataprestasi*') 
                                    ? 'menu-open'
                                    : '' }} ">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    WALI KELAS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/datakelas' }}"
                                        class="nav-link {{ Request::is($user->role . '/datakelas*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/nilaisosial' }}"
                                        class="nav-link {{ Request::is($user->role . '/nilaisosial*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Nilai Sosial</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/nilaispiritual' }}"
                                        class="nav-link {{ Request::is($user->role . '/nilaispiritual*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Nilai Spiritual</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/kehadiran' }}"
                                        class="nav-link {{ Request::is($user->role . '/kehadiran*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Ketidakhadiran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/catatan' }}"
                                        class="nav-link {{ Request::is($user->role . '/catatan*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Catatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ '/' . $user->role . '/dataprestasi' }}"
                                        class="nav-link {{ Request::is($user->role . '/dataprestasi*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Prestasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
                {{-- END WALI KELAS --}}

                {{-- GURU MAPEL --}}
                @if (Auth::user()->role == 'guru')
                    @if (count($guru->pembelajaran) > 0)
                        <li class="nav-item {{ Request::is('guru/datapembelajaran*') ? 'menu-open' : '' }} ">
                            <a href="#" class="nav-link {{ Request::is('guru/datapembelajaran*') ? 'active' : '' }} ">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    GURU
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ '/guru/datapembelajaran' }}" class="nav-link {{ Request::is('guru/datapembelajaran*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Nilai Pelajaran</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
                {{-- END GURU MAPEL --}}

                {{-- PEMBINA EKSKUL --}}
                {{-- @php
                    if (Auth::user()->role === 'guru') {
                        $ekskul = Ekstrakurikuler::where('guru_id', auth()->user()->guru->id)->get();
                    }
                @endphp

                @if (Auth::user()->role === 'guru')
                    @if ($ekskul->count() > 0)
                        @can('pembina')
                        <li class="nav-item {{ Request::is('guru/dataekstrakurikuler*') ? 'menu-open' : '' }} ">
                            <a href="#" class="nav-link {{ Request::is('guru/dataekstrakurikuler*') ? 'active' :  '' }} ">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    PEMBINA EKSKUL
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ '/guru/dataekstrakurikuler' }}" class="nav-link {{ Request::is('guru/dataekstrakurikuler*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Ekstrakurikuler</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                    @endif
                @endif --}}
                {{-- END PEMBINA EKSKUL --}}


                @if (Auth::user()->role == 'guru' && is_null(Auth::user()->guru->kelas))
                @else
                    <li class="nav-header mt-2 fw-bold">RAPORT</li>

                    <li class="nav-item">
                        @if ($siswa)
                            <a href="{{ '/' . $user->role . '/nilaiakhir/' . $siswa->kelas->id }}" class="nav-link {{ Request::is($user->role . '/nilaiakhir*') ? 'active' : '' }}">
                        {{-- @elseif ($walisiswa)
                            <a href="{{ '/' . $user->role . '/nilaiakhir/' . $walisiswa->siswa->kelas->id }}" class="nav-link {{ Request::is($user->role . '/nilaiakhir*') ? 'active' : '' }}"> --}}
                        @else
                            <a href="{{ '/' . $user->role . '/nilaiakhir' }}" class="nav-link {{ Request::is($user->role . '/nilaiakhir*') ? 'active' : '' }}">
                        @endif
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Nilai Akhir
                                </p>
                            </a>
                    </li>

                    <li class="nav-item">
                        @if ($siswa)
                            <a href="{{ '/' . $user->role . '/cetakraport/' . $siswa->kelas->id }}"
                                class="nav-link {{ Request::is($user->role . '/cetakraport*') ? 'active' : '' }}">
                        {{-- @elseif ($walisiswa)
                            <a href="{{ '/' . $user->role . '/cetakraport/' . $walisiswa->siswa->kelas->id }}" class="nav-link {{ Request::is($user->role . '/cetakraport*') ? 'active' : '' }}"> --}}
                        @else
                            <a href="{{ '/' . $user->role . '/cetakraport' }}" class="nav-link {{ Request::is($user->role . '/cetakraport*') ? 'active' : '' }}">
                        @endif

                                <i class="nav-icon fas fa-file"></i>
                                <p>Cetak Raport</p>
                            </a>
                    </li>
                @endif

                <li class="nav-header mt-2 fw-bold">Saya</li>

                <li class="nav-item 
                    {{ Request::is($user->role . '/profil*') | Request::is($user->role . '/logout*') ? 'menu-open' : '' }} ">
                    <a href="#"
                        class="nav-link 
                        {{ Request::is($user->role . '/profil*') | Request::is($user->role . '/logout*') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            PENGATURAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ '/' . $user->role . '/profil' }}" class="nav-link 
                                {{ Request::is($user->role . '/profil*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal-logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
