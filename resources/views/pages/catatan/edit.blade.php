@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Catatan - Kelas {{ $kelas->name }}</h1>
                </div>
                <div class="col-sm-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
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
                                        {{ $kelas->guru->name }}{{ $kelas->guru->gelar ? ', ' . $kelas->guru->gelar : '' }}
                                    </div>
                                    <div class="col-md-4 fw-bold">
                                        Tahun Pelajaran
                                    </div>
                                    <div class="col-md-8">
                                        : {{ $kelas->tapel->tahun_pelajaran }}
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
                            @if (!$catatan)
                                Belum ada Data Catatan.
                            @else
                                <div class="table-responsive">
                                    <form
                                        action="{{ route('catatan.update', ['catatan' => $kelas->id, 'role' => auth()->user()->role]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <table id="" class="table table-sm table-hover ">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th scope="col">#</th>
                                                    <th scope="col">NIS</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">L/P</th>
                                                    <th scope="col">Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $i => $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nis }}</td>
                                                        <td style="max-width: 300px" class="text-uppercase">
                                                            {{ $item->name }}</td>
                                                        <td>{{ $item->jk }}</td>
                                                        <td>
                                                            <input type="hidden" name="siswa_id[]"
                                                                value="{{ $item->id }}">
                                                            <textarea name="catatan[]" id="" cols="20" class="form-control" rows="3">{{ $catatan->where('siswa_id', $item->id)->first()->catatan ?? '' }}</textarea>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-success float-right">
                                            Simpan
                                        </button>
                                        <div class="checkbox float-right me-3">
                                            <label>
                                                <input type="checkbox" class="mt-3" required>
                                                Saya yakin akan mengubah data tersebut
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <script src="/my-js/jquery.js"></script>
                                <script>
                                    function getRandomCatatan() {
                                        const catatanOptions = [
                                            'Teruskan usaha yang baik. Anda menunjukkan kemajuan yang signifikan!',
                                            'Perlu fokus lebih pada beberapa area untuk mencapai hasil yang lebih baik.',
                                            'Ada beberapa hal yang perlu diperhatikan dan diperbaiki untuk hasil yang lebih baik.',
                                            'Tetap semangat dan jangan ragu untuk meminta bantuan jika diperlukan!',
                                            'Anda telah melakukan pekerjaan dengan baik, tetapi ada ruang untuk peningkatan lebih lanjut.',
                                            'Pertimbangkan untuk menetapkan tujuan baru untuk mengembangkan keterampilan Anda lebih jauh.'
                                        ];

                                        // Pilih catatan acak
                                        const randomIndex = Math.floor(Math.random() * catatanOptions.length);
                                        return catatanOptions[randomIndex];
                                    }

                                    $(document).ready(function() {
                                        // Isi textarea dengan catatan acak saat halaman dimuat
                                        $("textarea[name='catatan[]']").each(function() {
                                            $(this).val(getRandomCatatan());
                                        });
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
