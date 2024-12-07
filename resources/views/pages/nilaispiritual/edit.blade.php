@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Spiritual - Kelas {{ $kelas->name }}</h1>
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
                            @if (!$nilaiSpiritual)
                                Belum ada Nilai Spiritual.
                            @else
                                <div class="table-responsive">
                                    <form
                                        action="{{ route('nilaispiritual.update', ['nilaispiritual' => $kelas->id, 'role' => $role]) }}"
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
                                                    <th scope="col">Predikat</th>
                                                    <th scope="col">Deskripsi</th>
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
                                                            <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                                            <select aria-readonly="true" class="form-select @error('predikat') is-invalid @enderror" name="predikat[]" id="exampleSelectBorder" required onchange="updateDeskripsi(this)">
                                                                <option value="B" disabled selected>-- Pilih Predikat --</option>
                                                                <option value="A" {{ 'A' == old('predikat', $nilaiSpiritual->where('siswa_id', $item->id)->first() ? $nilaiSpiritual->where('siswa_id', $item->id)->first()->predikat == 'A' : '') ? 'selected' : '' }}>
                                                                    A (Sangat Baik)
                                                                </option>
                                                                <option value="B" {{ 'B' == old('predikat', $nilaiSpiritual->where('siswa_id', $item->id)->first() ? $nilaiSpiritual->where('siswa_id', $item->id)->first()->predikat == 'B' : '') ? 'selected' : '' }}>
                                                                    B (Baik)
                                                                </option>
                                                                <option value="C" {{ 'C' == old('predikat', $nilaiSpiritual->where('siswa_id', $item->id)->first() ? $nilaiSpiritual->where('siswa_id', $item->id)->first()->predikat == 'C' : '') ? 'selected' : '' }}>
                                                                    C (Cukup)
                                                                </option>
                                                                <option value="D" {{ 'D' == old('predikat', $nilaiSpiritual->where('siswa_id', $item->id)->first() ? $nilaiSpiritual->where('siswa_id', $item->id)->first()->predikat == 'D' : '') ? 'selected' : '' }}>
                                                                    D (Kurang)
                                                                </option>
                                                            </select>
                                                            @error('predikat')
                                                                <span class="invalid-feedback mt-1">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <textarea name="deskripsi[]" placeholder="Masukkan deskripsi" class="form-control" id="" cols="30"
                                                                rows="5">{{ $nilaiSpiritual->where('siswa_id', $item->id)->first() ? $nilaiSpiritual->where('siswa_id', $item->id)->first()->deskripsi : '' }}</textarea>
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

    <script>
        function updateDeskripsi(select) {
            // Ambil nilai predikat yang dipilih
            let predikat = select.value;
            let deskripsi = '';
        
            // Tentukan deskripsi berdasarkan predikat
            switch (predikat) {
                case 'A':
                    deskripsi = 'Menunjukkan pemahaman dan praktik spiritual yang sangat mendalam. Selalu terlibat dalam kegiatan spiritual dan menunjukkan komitmen yang kuat.';
                    break;
                case 'B':
                    deskripsi = 'Memiliki pemahaman spiritual yang baik dan sering terlibat dalam kegiatan spiritual. Kadang-kadang menunjukkan kekuatan dan dedikasi yang konsisten.';
                    break;
                case 'C':
                    deskripsi = 'Memiliki pemahaman dasar tentang nilai-nilai spiritual. Terlibat dalam kegiatan spiritual secara sporadis, dengan kebutuhan untuk meningkatkan praktik dan komitmen.';
                    break;
                case 'D':
                    deskripsi = 'Memerlukan perhatian lebih dalam hal pemahaman dan praktik spiritual. Perlu bimbingan lebih lanjut untuk meningkatkan keterlibatan dan pemahaman spiritual.';
                    break;
                default:
                    deskripsi = ''; // Kosongkan deskripsi jika predikat tidak valid
                    break;
            }
        
            // Temukan textarea terkait dan perbarui isinya
            let row = $(select).closest('tr');
            row.find("textarea[name='deskripsi[]']").val(deskripsi);
        }
    </script>

@endsection
