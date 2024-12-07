<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="kelas_id" class="col-sm-4 col-form-label">Nama Pembelajaran</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ $pembelajaran->mapel->name }} - {{ $pembelajaran->kelas->name }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="guru_id" class="col-sm-4 col-form-label">Guru Pengampu</label>
            <div class="col-sm-8">
                <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id" id="exampleSelectBorder">
                    <option value="" disabled selected>-- Pilih Guru --</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('guru_id', $pembelajaran->guru_id) ? 'selected' : '' }}>
                            {{ $item->name }}{{ $item->gelar ? ', ' . $item->gelar : '' }}
                        </option>
                    @endforeach
                </select>
                @error('guru_id')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="kkm" class="col-sm-4 col-form-label">KKM</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('kkm', $pembelajaran->kkm) }}" class="form-control @error('kkm') is-invalid @enderror " name="kkm" id="" placeholder="Masukkan KKM pembelajaran" oninput="inputKKM(this)">
                @error('kkm')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="offset-sm-4 col-sm-8 mt-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" required> Saya yakin akan mengubah data tersebut
                </label>
            </div>
        </div>
        <div class="offset-sm-4 col-sm-8 mt-2">
            <a class="btn btn-danger" href="{{ route('datapembelajaran.index', $role) }}">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</div>
<script>
    function inputKKM(input) {
        // Ambil nilai dari input dan pastikan itu adalah integer
        let value = parseInt(input.value, 10);

        // Periksa jika nilai bukan angka atau kurang dari 0
        if (isNaN(value) || value < 0) {
            input.value = '';
        } 
        // Periksa jika nilai lebih dari 100
        else if (value > 100) {
            input.value = 100;
            // Opsional: Tampilkan pesan peringatan jika diperlukan
            alert('Nilai tidak boleh lebih dari 100.');
        }
    }
</script>
