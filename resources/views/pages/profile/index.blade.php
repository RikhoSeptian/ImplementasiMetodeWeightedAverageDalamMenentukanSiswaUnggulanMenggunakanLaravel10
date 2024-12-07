@php

    use App\Models\User;
    use Carbon\Carbon;

    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    // $walisiswa = Auth::user()->walisiswa;
    $siswa = Auth::user()->siswa;

    // $getUser = User::getUser()->name;

    if ($admin) {
        $userLogin = $admin;
    } elseif ($guru) {
        $userLogin = $guru;
    } elseif ($siswa) {
        $userLogin = $siswa;
    } 
    // elseif ($walisiswa) {
    //     $userLogin = $walisiswa;
    // }

    $role = auth()->user()->role;

@endphp

@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil Saya</h1>
                </div>
                <div class="col-sm-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('notification.success')
                            {{ session('info') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-outline">
                        <div class="card-body box-profile mt-3">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle img-profile" src="{{ asset('/img/' . $userLogin->foto ?? '') }}" alt="User profile picture">
                            </div>
                            <h5 class="text-center fw-bold mt-3">
                                {{ $userLogin->name }}{{ $userLogin->gelar ? ', ' . $userLogin->gelar : '' }}
                            </h5>
                            <p class="text-muted text-center text-capitalize">
                                {{ auth()->user()->role == 'walisiswa' ? 'Wali Siswa' : auth()->user()->role }}
                            </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Username</b>
                                    <a class="float-right text-secondary"> {{ Auth::user()->username }} </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <a class="float-right text-secondary"> {{ Auth::user()->email }} </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b>
                                    <a class="float-right text-secondary">
                                        @if ($admin)
                                            Administrator
                                        @elseif (Auth::user()->role == 'guru' && $guru->kelas && $guru->ekstrakurikuler)
                                            <dl class="float-right">
                                                <li>Guru Mapel</li>
                                                <li>Wali Kelas: {{ $guru->kelas->name ?? '' }}</li>
                                                <li>Pembina Ekskul: {{ $guru->ekstrakurikuler[0]->name ?? '' }}</li>
                                            </dl>
                                        @elseif (Auth::user()->role == 'guru' && $guru->kelas)
                                            <dl class="float-right">
                                                <li>Guru Mapel</li>
                                                <li>Wali Kelas {{ $guru->kelas->name ?? '' }}</li>
                                            </dl>
                                        @elseif ($guru)
                                            Guru
                                        @elseif($siswa)
                                            Siswa - {{ $siswa->kelas->name }}
                                        {{-- @elseif ($walisiswa)
                                                Wali Siswa
                                                <b> {{ $walisiswa->siswa->name }} </b> --}}
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-mine">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#profil" data-toggle="tab">
                                        Edit Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#foto" data-toggle="tab">
                                        Edit Foto
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#akun" data-toggle="tab">
                                        Edit Akun
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profil">
                                    <form class="form-horizontal" action="{{ route('profil.update', $userLogin->user_id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Maukkan nama lengkap" value="{{ $userLogin->name }}" {{ $role == 'siswa' ? 'readonly' : '' }}>
                                                @error('name')
                                                    <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if ($role == 'siswa')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NIS</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="" class="form-control @error('nis') is-invalid @enderror" id="nip" placeholder="NIS" value="{{ $userLogin->nis }}" readonly>
                                                    @error('nis')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NISN</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="" class="form-control @error('nisn') is-invalid @enderror" id="nuptk" placeholder="NISN" value="{{ $userLogin->nisn }}" readonly>
                                                    @error('nisn')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if ($role == 'admin' || $role == 'guru')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Gelar</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="gelar" class="form-control @error('gelar') is-invalid @enderror" id="gelar" placeholder="gelar" value="{{ $userLogin->gelar }}">
                                                    @error('gelar')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select class="form-select @error('jk') is-invalid @enderror"
                                                    name="jk" id="exampleSelectBorder">
                                                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                                    <option value="L" {{ $userLogin->jk == 'L' ? 'selected' : '' }}>
                                                        Laki-laki
                                                    </option>
                                                    <option value="P" {{ $userLogin->jk == 'P' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                                @error('jk')
                                                    <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if ($role == 'walisiswa')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Wali Siswa
                                                    Dari</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="" class="form-control"
                                                        id="gelar" placeholder="Masukkan nama siswa"
                                                        value="{{ $userLogin->siswa->name }} - {{ $userLogin->siswa->kelas->name }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Sebagai</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select @error('sebagai') is-invalid @enderror"
                                                        name="sebagai" id="exampleSelectBorder">
                                                        <option value="" disabled>-- Pilih Peran --</option>
                                                        <option value="1"
                                                            {{ $userLogin->sebagai == '1' ? 'selected' : '' }}>Ayah
                                                        </option>
                                                        <option value="2"
                                                            {{ $userLogin->sebagai == '2' ? 'selected' : '' }}>Ibu</option>
                                                        <option value="3"
                                                            {{ $userLogin->sebagai == '3' ? 'selected' : '' }}>Wali
                                                        </option>
                                                    </select>
                                                    @error('sebagai')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if ($role == 'admin' || $role == 'guru')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NIP</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nip"
                                                        class="form-control @error('nip') is-invalid @enderror"
                                                        id="nip" placeholder="nip" value="{{ $userLogin->nip }}">
                                                    @error('nip')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NUPTK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nuptk"
                                                        class="form-control @error('nuptk') is-invalid @enderror"
                                                        id="nuptk" placeholder="nuptk"
                                                        value="{{ $userLogin->nuptk }}">
                                                    @error('nuptk')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if ($role != 'walisiswa')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label"> Tempat Lahir
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tempatlahir"
                                                        class="form-control @error('tempatlahir') is-invalid @enderror"
                                                        id="tempatlahir" placeholder="tempat lahir"
                                                        value="{{ $userLogin->tempatlahir }}">
                                                    @error('tempatlahir')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Tanggal
                                                    Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="tanggallahir"
                                                        class="form-control @error('tanggallahir') is-invalid @enderror"
                                                        id="tanggallahir" placeholder="tanggal lahir"
                                                        value="{{ $userLogin->tanggallahir }}">
                                                    @error('tanggallahir')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Telepon</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="telepon"
                                                        class="form-control @error('telepon') is-invalid @enderror"
                                                        id="telepon" placeholder="telepon"
                                                        value="{{ $userLogin->telepon }}">
                                                    @error('telepon')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="inputExperience"
                                                        placeholder="Masukkan alamat">{{ $userLogin->alamat }}</textarea>
                                                    @error('alamat')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if ($role == 'siswa')
                                            <div class="form-group row mt-3">
                                                <label for="inputName" class="col-sm-3 col-form-label">Nama Ayah</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="namaayah"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="namaayah" placeholder="Masukkan nama ayah"
                                                        value="{{ $userLogin->namaayah }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Pekerjaan
                                                    Ayah</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="pekerjaanayah"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="pekerjaanayah" placeholder="Masukkan pekerjaan ayah"
                                                        value="{{ $userLogin->pekerjaanayah }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Nama Ibu</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="namaibu"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="namaibu" placeholder="Masukkan nama ibu"
                                                        value="{{ $userLogin->namaibu }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Pekerjaan
                                                    Ibu</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="pekerjaanibu"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="pekerjaanibu" placeholder="Masukkan pekerjaan ibu"
                                                        value="{{ $userLogin->pekerjaanibu }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Nama Wali</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="namawali"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="namawali" placeholder="Masukkan nama wali"
                                                        value="{{ $userLogin->namawali }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Pekerjaan
                                                    Wali</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="pekerjaanwali"
                                                        class="form-control @error('abc') is-invalid @enderror"
                                                        id="pekerjaanwali" placeholder="Masukkan pekerjaan wali"
                                                        value="{{ $userLogin->pekerjaanwali }}">
                                                    @error('abc')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <input type="hidden" name="user_id" id=""
                                            value="{{ auth()->user()->id }}" hidden>

                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required>
                                                        Saya yakin akan mengubah data tersebut
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- FOTO --}}
                                <div class="tab-pane" id="foto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mt-xs-2">
                                                    <tr class="text-center text-bold">
                                                        <td>Foto</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">
                                                            <img src="{{ asset('/img/' . $userLogin->foto) }}"
                                                                alt="" class="rounded-circle img-profile">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <small class="fs-12"><i>Ganti foto user</i></small>
                                            <form action="{{ route('foto.update', $userLogin->user_id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="oldPhoto" id=""
                                                    value="{{ $userLogin->foto }}" hidden>

                                                <div class="">
                                                    <div class="my-2 position-relative">
                                                        <img class="img-preview img-fluid mb-2 col-sm-6 rounded oferflow-y-hidden"
                                                            style="max-width: 200px;">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ $userLogin->user_id }}">
                                                        <input type="file" accept="image/*"
                                                            class="form-control @error('files') is-invalid @enderror"
                                                            name="files" id="gambar" onchange="previewImage()">

                                                        <button type="submit" class="input-group-text btn-primary"
                                                            for="inputGroupFile02">Update</button>
                                                        @error('files')
                                                            <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- AKUN --}}
                                <div class="tab-pane " id="akun">
                                    <form class="form-horizontal"
                                        action="{{ route('akunsaya.update', $userLogin->user->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    value="{{ old('username', $userLogin->user->username) }}"
                                                    class="form-control @error('username') is-invalid @enderror "
                                                    name="username" placeholder="Masukkan username">
                                                @error('username')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Email
                                                <small>(Opsional)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{ old('email', $userLogin->user->email) }}"
                                                    class="form-control @error('email') is-invalid @enderror "
                                                    name="email" placeholder="Masukkan email">
                                                @error('email')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password
                                                <small>(opsional)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Masukkan password baru">
                                                @error('password')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="offset-sm-3 col-sm-8 mt-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> Saya yakin akan mengubah data tersebut
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-sm-3 col-sm-8 mt-2">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->

                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
