@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pembelajaran @can('gurumapel')
                            Saya
                        @endcan
                    </h1>
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
                                <div class="row col-md-12">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6 col-md-12 row">
                                            <div class="col-md-4 fw-bold">
                                                Mata Pelajaran
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pembelajaran->mapel->name }}
                                            </div>
                                            <div class="col-md-4 fw-bold">
                                                Kelas
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pembelajaran->kelas->name }}
                                            </div>
                                            <div class="col-md-4 fw-bold">
                                                KKM
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pembelajaran->kkm }}
                                            </div>
                                            <div class="col-md-4 fw-bold">
                                                Guru Pengampu
                                            </div>
                                            <div class="col-md-8">
                                                :
                                                {{ $pembelajaran->guru->name }}{{ $pembelajaran->guru->gelar ? ', ' . $pembelajaran->guru->gelar : '' }}
                                            </div>
                                            <div class="col-md-4 fw-bold">
                                                Tahun Pelajaran
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pembelajaran->mapel->tapel->tahun_pelajaran }} - Semester
                                                {{ $pembelajaran->mapel->tapel->semester }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-md-2-md-2 row">
                                            <h5 class="text-center">Menentukan Bobot</h5>
                                            <div class="col-md-6">
                                                <label for="Pengetahuan" class="form-label fs-6">Pengetahuan</label>
                                                <input type="number" class="form-control form-control-sm input-bobot" name="bobot_pengetahuan[]" id="bobot_pengetahuan" value="15" placeholder="Masukkan bobot" oninput="validateBobot(this)">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Keterampilan" class="form-label fs-6">Keterampilan</label>
                                                <input type="number" class="form-control form-control-sm input-bobot" name="bobot_keterampilan[]" id="bobot_keterampilan" value="15" placeholder="Masukkan bobot" oninput="validateBobot(this)">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="PTS" class="form-label fs-6">PTS</label>
                                                <input type="number" class="form-control form-control-sm input-bobot" name="bobot_pts[]" id="bobot_pts" value="30" placeholder="Masukkan bobot" oninput="validateBobot(this)">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="PAS" class="form-label fs-6">PAS</label>
                                                <input type="number" class="form-control form-control-sm input-bobot" name="bobot_pas[]" id="bobot_pas" value="40" placeholder="Masukkan bobot" oninput="validateBobot(this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($siswa) < 1)
                                Belum ada Siswa di Pembelajaran ini.
                            @else
                                <div class="table-responsive">
                                    <form action="{{ route('datapembelajaran.insertnilai', $pembelajaran->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <table id="" class="table table-sm table-hover">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th scope="col" rowspan="2">#</th>
                                                    <th scope="col" rowspan="2">NIS</th>
                                                    <th scope="col" rowspan="2">Nama</th>
                                                    <th scope="col" colspan="2" class="text-center bg-warning">Nilai Harian</th>
                                                    <th scope="col" rowspan="2">Nilai PTS</th>
                                                    <th scope="col" rowspan="2">Nilai PAS</th>
                                                    <th scope="col" rowspan="2">Rata-Rata</th>
                                                    <th scope="col" rowspan="2">Deskripsi</th>
                                                </tr>
                                                <tr class="bg-primary">
                                                    <th scope="col">Pengetahuan</th>
                                                    <th scope="col">Keterampilan</th>
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
                                                        <td>
                                                            <input type="hidden" name="siswa_id[]"
                                                                value="{{ $item->id }}">
                                                            <input type="number" class="form-control input-nilai" name="nilai_pengetahuans[]" id="nilai_pengetahuans" value="{{ $nilaiPengetahuan->where('siswa_id', $item->id)->first() ? $nilaiPengetahuan->where('siswa_id', $item->id)->first()->nilai : '' }}" oninput="inputNilai(this)">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control input-nilai" name="nilai_keterampilans[]" id="nilai_keterampilans" value="{{ $nilaiKeterampilan->where('siswa_id', $item->id)->first() ? $nilaiKeterampilan->where('siswa_id', $item->id)->first()->nilai : '' }}" oninput="inputNilai(this)">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control input-nilai" name="nilai_pts[]" id="nilai_pts" value="{{ $nilaiPts->where('siswa_id', $item->id)->first() ? $nilaiPts->where('siswa_id', $item->id)->first()->nilai : '' }}" oninput="inputNilai(this)">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control input-nilai" name="nilai_pas[]" id="nilai_pas" value="{{ $nilaiPas->where('siswa_id', $item->id)->first() ? $nilaiPas->where('siswa_id', $item->id)->first()->nilai : '' }}" oninput="inputNilai(this)">
                                                        </td>
                                                        <td class="rataRata fw-bold">
                                                            {{-- Menggunakan JQuery --}}
                                                        </td>
                                                        <td>
                                                            <textarea name="deskripsi[]" class="form-control" id="" cols="30" rows="5">{{ $nilaiAkhir->where('siswa_id', $item->id)->first() ? $nilaiAkhir->where('siswa_id', $item->id)->first()->deskripsi : '' }}</textarea>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                                        <div class="checkbox float-right me-3">
                                            <label>
                                                <input type="checkbox" class="mt-3" required>
                                                Saya yakin akan mengubah data tersebut
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <script src="{{ asset('my-js/jquery.js') }}"></script>
                                <script>
                                    function validateBobot(input) {
                                        // Ambil nilai dari input dan pastikan itu adalah integer
                                        let value = parseInt(input.value, 10);

                                        // Periksa jika nilai bukan angka atau kurang dari 0
                                        if (isNaN(value) || value < 0) {
                                            input.value = '';
                                        } 
                                        // Periksa jika nilai lebih dari 100
                                        else if (value > 100) {
                                            input.value = 100;
                                        } 
                                    }
                                    
                                    function inputNilai(input) {
                                        // Ambil nilai dari input dan pastikan itu adalah integer
                                        let value = parseInt(input.value, 10);
                                        // input.value = Math.floor(Math.random() * (101 - 70) + 70); 


                                        // Periksa jika nilai bukan angka atau kurang dari 0
                                        if (isNaN(value) || value < 0) {
                                            input.value = '';
                                            // input.value = Math.floor(Math.random() * (101 - 70) + 70); 
                                        } 
                                        // Periksa jika nilai lebih dari 100
                                        else if (value > 100) {
                                            input.value = 100;
                                        } 
                                    }

                                    $(document).ready(function() {
                                        // Bobot yang diinputkan
                                        var bobotPengetahuan = parseFloat($('#bobot_pengetahuan').val()) || 0;
                                        var bobotKeterampilan = parseFloat($('#bobot_keterampilan').val()) || 0;
                                        var bobotPTS = parseFloat($('#bobot_pts').val()) || 0;
                                        var bobotPAS = parseFloat($('#bobot_pas').val()) || 0;
                                    
                                        function hitungRataRata() {
                                            $(".rataRata").each(function() {
                                                var row = $(this).closest("tr");
                                    
                                                var nilaiPengetahuan = parseFloat(row.find("input[name='nilai_pengetahuans[]']").val()) || 0;
                                                var nilaiKeterampilan = parseFloat(row.find("input[name='nilai_keterampilans[]']").val()) || 0;
                                                var nilaiPTS = parseFloat(row.find("input[name='nilai_pts[]']").val()) || 0;
                                                var nilaiPAS = parseFloat(row.find("input[name='nilai_pas[]']").val()) || 0;
                                    
                                                var totalBobot = 0;
                                                var totalNilaiBobot = 0;
                                    
                                                // Menghitung total bobot dan total nilai bobot
                                                if (nilaiPengetahuan !== 0) {
                                                    totalBobot += bobotPengetahuan;
                                                    totalNilaiBobot += nilaiPengetahuan * bobotPengetahuan;
                                                }
                                                if (nilaiKeterampilan !== 0) {
                                                    totalBobot += bobotKeterampilan;
                                                    totalNilaiBobot += nilaiKeterampilan * bobotKeterampilan;
                                                }
                                                if (nilaiPTS !== 0) {
                                                    totalBobot += bobotPTS;
                                                    totalNilaiBobot += nilaiPTS * bobotPTS;
                                                }
                                                if (nilaiPAS !== 0) {
                                                    totalBobot += bobotPAS;
                                                    totalNilaiBobot += nilaiPAS * bobotPAS;
                                                }
                                    
                                                var rataRata = (totalBobot > 0) ? (totalNilaiBobot / totalBobot) : 0;
                                                $(this).text(rataRata.toFixed(2));

                                                if (rataRata >= 70 && rataRata < 85) {
                                                    deskripsi = 'Tercapai';
                                                } else if (rataRata >= 85 && rataRata < 100) {
                                                    deskripsi = 'Terlampaui';
                                                }

                                                // Perbarui textarea dengan deskripsi yang sesuai
                                                row.find("textarea[name='deskripsi[]']").val(deskripsi);
                                            });
                                        }
                                    
                                        // Trigger perhitungan rata-rata berbobot saat input berubah
                                        $(document).on("input", ".input-bobot, .input-nilai", function() {
                                            // Update bobot berdasarkan input terbaru
                                            bobotPengetahuan = parseFloat($('#bobot_pengetahuan').val()) || 0;
                                            bobotKeterampilan = parseFloat($('#bobot_keterampilan').val()) || 0;
                                            bobotPTS = parseFloat($('#bobot_pts').val()) || 0;
                                            bobotPAS = parseFloat($('#bobot_pas').val()) || 0;
                                            
                                            hitungRataRata();
                                        });
                                    
                                        // Initial calculation on page load
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
