@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cetak Raport - Kelas {{ $kelas->name ? $kelas->name : '' }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="callout callout-warning my-1">

                                <div class="row col-md-6">
                                    <div class="col-md-4 fw-bold">
                                        Wali Kelas
                                    </div>
                                    <div class="col-md-8">
                                        :
                                        {{ $kelas->guru->name ? $kelas->guru->name : '-' }}{{ $kelas->guru->gelar ? ', ' . $kelas->guru->gelar : '' }}
                                    </div>
                                    <div class="col-md-4 fw-bold">
                                        Tahun Pelajaran
                                    </div>
                                    <div class="col-md-8">
                                        : {{ $kelas->tapel->tahun_pelajaran ? $kelas->tapel->tahun_pelajaran : '-' }}
                                    </div>
                                    <div class="col-md-4 fw-bold">
                                        Semester
                                    </div>
                                    <div class="col-md-8">
                                        : {{ $kelas->tapel->semester == '1' ? '1 / Ganjil' : '2 / Genap' }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (!$siswa)
                                Belum ada Data Kehadiran.
                            @else
                                <div class="table-responsive">
                                    {{-- <form action="{{ route('kehadiran.update', $kelas->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') --}}

                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">L/P</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nis }}</td>
                                                    <td style="max-width: 300px" class="text-uppercase">
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>{{ $item->jk }}</td>
                                                    <td>
                                                        {{-- <input type="hidden" name="siswa_id[]" value="{{ $item->id }}"> --}}
                                                        <form action="{{ route('cetakraport.print', ['id' => $item->id, 'nisn' => $item->nisn ? $item->nisn : '-']) }}" method="get" target="_blank">
                                                            {{-- @csrf --}}
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                                                                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                                                                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                                                </svg>
                                                                Cetak Raport</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{-- </form> --}}
                                </div>

                                <script src="/my-js/jquery.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        function hitungRataRata() {
                                            $(".rataRata").each(function() {
                                                var row = $(this).closest("tr");
                                                var sakit = parseFloat(row.find("input[name='sakit[]']")
                                                    .val()) || 0;
                                                var izin = parseFloat(row.find("input[name='izin[]']").val()) || 0;
                                                var tk = parseFloat(row.find("input[name='tk[]']").val()) || 0;

                                                var rataRata = (sakit + izin + tk);

                                                $(this).text(rataRata.toFixed(2));
                                            });
                                        }

                                        $(document).on("input", ".input-nilai", function() {
                                            hitungRataRata();
                                        });

                                        hitungRataRata();
                                    });
                                </script>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- MODAL PETUNJUK AKSI --}}
    <div class="modal fade text-black" id="petunjukAksi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

@endsection
