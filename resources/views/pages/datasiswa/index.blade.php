@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
                </div>
                <div class="col-sm-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('notification.success')
                            {!! session('info') !!}
                        </div>
                    @endif
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            @include('notification.failed')
                            {!! session('failed') !!}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            {{-- Petunjuk Aksi --}}
                            <button class="btn btn-info d-inline btn-sm btn-icon-split float-right ms-2 rounded-circle" data-bs-toggle="modal" data-bs-target="#petunjukAksi">
                                <span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </button>

                            @can('admin')
                            <a href="{{ route('datasiswa.create', $role) }}" class="btn btn-sm float-left btn-primary btn-icon-split">
                                <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </span>
                                <span class="text">Siswa</span>
                            </a>

                            <a href="{{ route('file.download', ['filename' => 'Template.xlsx']) }}" class="btn btn-dark btn-sm float-end ml-2">
                                <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload me-1" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                    </svg>
                                </span>
                                <span class="text">Template</span>
                            </a>

                            <button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#importSiswa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload me-1" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg>
                                Import Data Siswa
                            </button>
                            @endcan

                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($siswa->count() > 0)
                                <div class="table-responsive">
                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">NISN</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">TTL</th>
                                                <th scope="col">Telepon</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->kelas && $item->kelas->name ? $item->kelas->name : '-' }}</td>
                                                    <td>{{ $item->nis ? $item->nis : '-' }}</td>
                                                    <td>{{ $item->nisn ? $item->nisn : '-' }}</td>
                                                    <td>{{ $item->jk == 'L' ? 'Laki-laki' : ($item->jk == 'P' ? 'Perempuan' : '-') }}</td>
                                                    <td>
                                                        {{ $item->tempatlahir && $item->tanggallahir ? $item->tempatlahir . ', ' . Carbon::createFromFormat('Y-m-d', $item->tanggallahir)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}
                                                    </td> 
                                                    <td>{{ $item->telepon ? $item->telepon : '-' }}</td>
                                                    <td>
                                                        @if ($item->status == '1')
                                                            <span class="badge px-1 bg-success">AKTIF</span>
                                                        @elseif ($item->status == '2')
                                                            <span class="badge px-1 bg-danger">NON-AKTIF</span>
                                                        @else
                                                            <span class="badge px-1 bg-info">LULUS</span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="#" type="button" class="btn btn-success pb-1 pt-0 px-2"  data-bs-toggle="modal" data-bs-target="#modalShow/{{ $item->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                                            </svg>
                                                        </a>

                                                        @can('admin')
                                                            <a href="{{ route('datasiswa.edit', ['datasiswa' => $item->id, 'role' => $role]) }}" type="button" class=" btn btn-primary pb-1 pt-0 px-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                </svg>
                                                            </a>

                                                            <button type="button" class=" btn btn-danger pb-1 pt-0 px-2 d-inline" data-bs-toggle="modal" data-bs-target="#modalDelete/{{ $item->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill pt-0" viewBox="0 0 16 16">
                                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade" id="modalDelete/{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-semibold poppins" id="exampleModalLabel">Hapus Data
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Data: 
                                                                        <p class="text-primary fw-bold">
                                                                            {{ $item->name ?? '-' }}{{ isset($item->kelas->name) ? ' - ' . $item->kelas->name : '' }}
                                                                        </p>
                                                                        Apakah anda yakin data tersebut akan dihapus?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                        <form action="{{ route('datasiswa.destroy', ['datasiswa' => $item->id, 'role' => $role]) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="user_id" id="" value="{{ $item->user_id }}" hidden>
                                                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- MODAL SHOW --}}
                                                        <div class="modal fade" id="modalShow/{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-md modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-semibold poppins" id="exampleModalLabel">Detail Data Siswa
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body pe-0">
                                                                        <div class="table-responsive row col-12">
                                                                            <table>
                                                                                <tr class="border-bottom">
                                                                                    <div class="text-center mb-3">
                                                                                        <img class="profile-user-img img-fluid img-circle" src="/img/{{ $item->foto ?? 'default.jpg' }}" alt="User profile picture">
                                                                                    </div>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Nama Lengkap</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->name }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Kelas</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->kelas && $item->kelas->name ? $item->kelas->name : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Jenis Kelamin</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->jk == 'L' ? 'Laki-laki' : ($item->jk == 'P' ? 'Perempuan' : '-') }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">NIS</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->nis ? $item->nis : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">NISN</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->nisn ? $item->nisn : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Tempat, Tanggal
                                                                                        Lahir</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>
                                                                                        {{ $item->tempatlahir && $item->tanggallahir ? $item->tempatlahir . ', ' . Carbon::createFromFormat('Y-m-d', $item->tanggallahir)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Agama</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>
                                                                                        @if ($item->agama == 1)
                                                                                            Islam
                                                                                        @elseif ($item->agama == 2)
                                                                                            Kristen
                                                                                        @elseif ($item->agama == 3)
                                                                                            Katolik
                                                                                        @elseif ($item->agama == 4)
                                                                                            Hindu
                                                                                        @elseif ($item->agama == 5)
                                                                                            Buddha
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Alamat</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->alamat ? $item->alamat : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Telepon</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->telepon ? $item->telepon : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Jenis Pendaftaran
                                                                                    </td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>
                                                                                        @if ($item->jenispendaftaran == 1)
                                                                                            Siswa Baru
                                                                                        @elseif ($item->jenispendaftaran == 2)
                                                                                            Siswa Pindahan
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Diterima Pada</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->diterimapada ? date('d-m-Y', strtotime($item->diterimapada)) : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Status Dalam
                                                                                        Keluarga</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>
                                                                                        @if ($item->statusdalamkeluarga == 1)
                                                                                            Anak Kandung
                                                                                        @elseif ($item->statusdalamkeluarga == 2)
                                                                                            Anak Angkat
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Anak Ke</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->anak_ke ? $item->anak_ke : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Nama Ayah</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->namaayah ? $item->namaayah : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Pekerjaan Ayah</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->pekerjaanayah ? $item->pekerjaanayah : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Nama Ibu</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->namaibu ? $item->namaibu : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Pekerjaan Ibu</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->pekerjaanibu ? $item->pekerjaanibu : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Nama Wali</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->namawali ? $item->namawali : '-' }}</td>
                                                                                </tr>
                                                                                <tr class="border-bottom">
                                                                                    <td class="fw-bold">Pekerjaan Wali</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>{{ $item->pekerjaanwali ? $item->pekerjaanwali : '-' }}</td>
                                                                                </tr>
                                                                                {{-- <tr class="border-bottom">
                                                                                    <td class="fw-bold">Status Siswa</td>
                                                                                    <td style="width: 1px;">:</td>
                                                                                    <td>
                                                                                        @if ($item->status == '1')
                                                                                            <span
                                                                                                class="badge px-1 bg-success">AKTIF</span>
                                                                                            @elseif
                                                                                            ($item->status == '2')
                                                                                            <span
                                                                                                class="badge px-1 bg-info">LULUS</span>
                                                                                        @else
                                                                                            <span
                                                                                                class="badge px-1 bg-info">NON-AKTIF</span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr> --}}
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @can('admin')
                                                                            <a href="{{ route('datasiswa.edit', ['datasiswa' => $item->id, 'role' => $role]) }}" type="button" class=" btn btn-primary">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                                </svg> Edit
                                                                            </a>
                                                                        @endcan

                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                Belum ada Data Siswa.
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL PETUNJUK AKSI --}}
    <div class="modal fade text-black" id="petunjukAksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Petunjuk Aksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-xs-14">
                    <table class="table table-borderless table-sm m-0">
                        @include('component.add')
                        @include('component.show')
                        @include('component.edit')
                        @include('component.delete')
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Import Data --}}
    <div class="modal fade" id="importSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('datasiswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title poppins fw-semibold" id="exampleModalLabel">Import Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Penting!</strong> File yang diunggah harus berupa dokumen Microsoft Excel dengan
                            ekstensi
                            .xlsx
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control" id="inputGroupFile01" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
