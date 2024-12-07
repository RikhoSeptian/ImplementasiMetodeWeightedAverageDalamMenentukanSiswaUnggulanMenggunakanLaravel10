@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            @include('_success')
                            {{ session('info') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
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
                            Edit Data Siswa
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datasiswa.update', ['datasiswa' => $siswa->id, 'role' => $role]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                @include('pages.datasiswa.editform')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
