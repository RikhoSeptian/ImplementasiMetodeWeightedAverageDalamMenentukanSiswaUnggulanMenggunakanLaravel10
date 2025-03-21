@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show mb-0 " role="alert">
                            @include('notification.success')
                            {!! session('info') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (!$sekolah)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Tambah Data Sekolah
                            </div>
                            <div class="card-body">
                                <form action="{{ route('datasekolah.store') }}" method="POST">
                                    @csrf

                                    @include('pages.datasekolah.addform')

                                    {{-- <input type="hidden" name="user_id" id="" value="1"> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Edit Data Sekolah
                            </div>
                            <div class="card-body">
                                <form action="{{ route('datasekolah.update', $sekolah->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    @include('pages.datasekolah.editform')

                                    {{-- <input type="hidden" name="user_id" id="" value="1"> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Edit Logo Sekolah
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-border table-hover mt-xs-2">
                                        <tr class="text-center table-secondary">
                                            <td>Logo</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('img/'.$sekolah->logo) }}" alt="" style="width: 120px" class="">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <small class="fs-12"><i>Ganti logo sekolah</i></small>
                                <form action="{{ route('logosekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="old_logo" id="" value="{{ $sekolah->logo }}" hidden>

                                    <div class="">
                                        <div class="my-2">
                                            <img class="img-preview img-fluid mb-2 col-sm-6 oferflow-y-hidden" style="max-width: 200px;">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="file" accept="image/*" class="form-control @error('files') is-invalid @enderror" name="files" id="gambar" onchange="previewImage()">
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
                @endif
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
