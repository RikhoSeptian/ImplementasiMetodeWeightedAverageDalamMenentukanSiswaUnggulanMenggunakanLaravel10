@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kelas</h1>
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
                            Tambah Data Kelas
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datakelas.store', $role) }}" method="POST">
                            @csrf
                            @include('pages.datakelas.addform')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
