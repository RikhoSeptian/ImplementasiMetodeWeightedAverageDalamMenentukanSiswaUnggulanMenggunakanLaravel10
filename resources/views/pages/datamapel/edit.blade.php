@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mata Pelajaran</h1>
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
                            Edit Data Mata Pelajaran
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datamapel.update', $mapel->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @include('pages.datamapel.editform')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
