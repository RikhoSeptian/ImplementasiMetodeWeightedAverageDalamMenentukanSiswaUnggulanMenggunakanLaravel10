@extends('layouts.app')

@section('content')

    @php
        use Carbon\Carbon;
        $role = Auth::user()->role;
    @endphp

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('notification.success')
                            {{ session('info') }}
                        </div>
                    @endif

                    @if (session()->has('login'))
                        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                            @include('notification.success')
                            Anda berhasil login sebagai <b class="text-uppercase"> {{ session('login') }} </b>
                        </div>
                    @endif

                </div>
                @if ($informasi->count() < 1)
                    @can('admin')
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-md p-1 mb-1 fw-bold float-right " data-bs-target="#addInformasi" data-bs-toggle="modal">
                                <span class="fas fa-plus pe-1"></span>
                                Informasi
                            </button>
                        </div>
                    @endcan
                @endif
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                @if ($informasi->count() > 0)
                    <div class="col-md-6 d-sm-none">
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label ms-2">
                                <span class="bg-emerald text-dark px-2">
                                    <span class="pe-1 fas fa-bullhorn"></span> Informasi
                                </span>
                                @can('admin')
                                    <button class="btn btn-transparent rounded-4 btn-md py-1 px-2 mb-1 fw-bold float-right me-3" data-bs-target="#addInformasi" data-bs-toggle="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="22" height="22" class="pb-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Informasi
                                    </button>
                                @endcan
                            </div>

                            @foreach ($informasi as $item)
                                <div>
                                    <i class="fas fa-envelope bg-emerald"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            @if (Str::before($item->created_at, ' ') == Carbon::now()->toDateString())
                                                {{ $item->created_at->diffForHumans() }}
                                            @elseif(Str::substr($item->created_at, 8, 2) + 1 == Str::substr(Carbon::now()->toDateString(), 8, 2))
                                                Kemarin
                                            @else
                                                {{ Carbon::createFromFormat('Y-m-d', Str::before($item->created_at, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}
                                            @endif
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        <h3 class="timeline-header">
                                            <a href="#" class="text-dark">
                                                @if ($item->user->role == 'admin')
                                                    {{ $item->user->guru->name }}{{ $item->user->guru->gelar ? ', ' . $item->user->guru->gelar : '' }}
                                                @elseif ($item->user->role == 'guru')
                                                    {{ $item->user->guru->name }}{{ $item->user->guru->gelar ? ', ' . $item->user->guru->gelar : '' }}
                                                @elseif ($item->user->role == 'siswa')
                                                    {{ $item->user->siswa->name }}
                                                @else
                                                    -
                                                @endif
                                            </a>
                                        </h3>

                                        <div class="timeline-body">
                                            {{ Str::limit($item->isi, 50, '...') }}
                                        </div>
                                        <div class="timeline-footer d-flex justify-content-between">
                                            <a class="btn btn-zinc btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#showInformasiXS{{ $item->id }}">
                                                Lihat detail
                                            </a>

                                            @can('admin')
                                                <button type="submit" class="btn btn-red btn-sm rounded-circle" data-bs-target="#deleteInformasiXS{{ $item->id }}" data-bs-toggle="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            @endcan
                                        </div>

                                        {{-- MODAL SHOW --}}
                                        <div class="modal fade" id="showInformasiXS{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"  id="staticBackdropLabel">
                                                            {{ $item->judul }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->isi }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                            Oke
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- MODAL HAPUS --}}
                                        <div class="modal fade" id="deleteInformasiXS{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            Hapus Informasi
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Data: <br>
                                                        <b>{{ $item->judul }}</b>

                                                        <br> <br>
                                                        Apakah anda yakin informasi tersebut akan dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                                        <form action="{{ route('informasi.destroy', $item->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit" class="btn btn-primary">Hapus</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row ">

                            @if (Auth::user()->role === 'siswa')
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-blues">
                                        <div class="inner">
                                            <h3>Nilai</h3>

                                            <p>Nilai Akhir</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion">💯</i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-successes">
                                        <div class="inner">
                                            <h3>Raport</h3>

                                            <p>Cetak Raport</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-clipboard"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-blues">
                                        <div class="inner">
                                            <h3>{{ $cSiswa }}</h3>

                                            <p>Siswa</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warnings">
                                        <div class="inner">
                                            <h3>{{ $cGuru }}</h3>

                                            <p>Guru</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-stalker"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-successes">
                                        <div class="inner">
                                            <h3>{{ $cEkstrakurikuler }}</h3>

                                            <p>Ekstrakurikuler</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ios-body"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-dangers">
                                        <div class="inner">
                                            <h3>{{ $cMapel }}</h3>

                                            <p>Mata Pelajaran</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-map"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-secondaries">
                                        <div class="inner">
                                            <h3>{{ $cKelas }}</h3>

                                            <p>Kelas</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-log-in"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-cyan">
                                        <div class="inner">
                                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                                            <p>Penilaian Selesai</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ios-checkmark-outline"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6 d-xs-none">
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label ms-2">
                                <span class="bg-emerald text-dark px-2">
                                    <span class="pe-1 fas fa-bullhorn"></span> Informasi
                                </span>

                                @can('admin')
                                    <button class="btn btn-transparent rounded-4 btn-md py-1 px-2 mb-1 fw-bold float-right me-3 align-items-center" data-bs-target="#addInformasi" data-bs-toggle="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="22" height="22" class="pb-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Informasi
                                    </button>
                                @endcan

                            </div>

                            @foreach ($informasi as $item)
                                <div>
                                    <i class="fas fa-envelope bg-emerald"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            @if (Str::before($item->created_at, ' ') == Carbon::now()->toDateString())
                                                {{ $item->created_at->diffForHumans() }}
                                            @elseif(Str::substr($item->created_at, 8, 2) + 1 == Str::substr(Carbon::now()->toDateString(), 8, 2))
                                                Kemarin
                                            @else
                                                {{ Carbon::createFromFormat('Y-m-d', Str::before($item->created_at, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}
                                            @endif
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        <h3 class="timeline-header"><a href="#" class="text-dark">
                                                @if ($item->user->role == 'admin')
                                                    {{ $item->user->guru->name }}{{ $item->user->guru->gelar ? ', ' . $item->user->guru->gelar : '' }}
                                                @elseif ($item->user->role == 'guru')
                                                    {{ $item->user->guru->name }}{{ $item->user->guru->gelar ? ', ' . $item->user->guru->gelar : '' }}
                                                @elseif ($item->user->role == 'siswa')
                                                    {{ $item->user->siswa->name }}
                                                @else
                                                    -
                                                @endif
                                            </a></h3>

                                        <div class="timeline-body">
                                            {{ Str::limit($item->isi, 50, '...') }}
                                        </div>
                                        <div class="timeline-footer d-flex justify-content-between">
                                            <a class="btn btn-zinc rounded-2 text-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#showInformasiSM{{ $item->id }}">
                                                Lihat detail
                                            </a>

                                            @can('admin')
                                                <button type="submit" class="btn btn-red btn-sm rounded-circle" data-bs-target="#deleteInformasiSM{{ $item->id }}" data-bs-toggle="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            @endcan

                                        </div>

                                        {{-- MODAL SHOW --}}
                                        <div class="modal fade" id="showInformasiSM{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            {{ $item->judul }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->isi }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- MODAL HAPUS --}}
                                        <div class="modal fade" id="deleteInformasiSM{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            Hapus Informasi
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Data: <br>
                                                        <b>{{ $item->judul }}</b>

                                                        <br> <br>
                                                        Apakah anda yakin informasi tersebut akan dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                                        <form action="{{ route('informasi.destroy', $item->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit" class="btn btn-primary">Hapus</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @else
                    <div class="col">
                        <div class="row ">

                            @if (Auth::user()->role === 'siswa')
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>Nilai</h3>

                                            <p>Nilai Akhir</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>Raport</h3>

                                            <p>Cetak Raport</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>{{ $cSiswa }}</h3>

                                            <p>Siswa</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $cGuru }}</h3>

                                            <p>Guru</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $cEkstrakurikuler }}</h3>

                                            <p>Ekstrakurikuler</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>{{ $cMapel }}</h3>

                                            <p>Mata Pelajaran</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-secondary">
                                        <div class="inner">
                                            <h3>{{ $cKelas }}</h3>

                                            <p>Kelas</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                                            <p>Penilaian Selesai</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            Lihat detail <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>
            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <!-- Main row -->
            <div class="modal fade" id="addInformasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('informasi.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}" hidden>

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-semibold poppins" id="exampleModalLabel">
                                    Tambah Informasi
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('pages.dashboard.addInformasi')
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    </div>

@endsection
