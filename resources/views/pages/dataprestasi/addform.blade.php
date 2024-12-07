<div class="row">
    <div class="col">
        <div class="form-group row">
            <label for="siswa_id" class="col-sm-4 col-form-label">Nama Siswa</label>
            <div class="col-sm-8">
                <select class="form-select @error('siswa_id') is-invalid @enderror" name="siswa_id"
                    id="exampleSelectBorder" required>
                    <option value="" disabled selected>-- Pilih Siswa --</option>
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('siswa_id') ? 'selected' : '' }}>
                            {{ $item->name . ' - ' . $item->kelas->name }}</option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="jenis" class="col-sm-4 col-form-label">Jenis Prestasi</label>
            <div class="col-sm-8">
                <select aria-readonly="true" class="form-select @error('jenis') is-invalid @enderror" name="jenis"
                    id="exampleSelectBorder" required>
                    <option value="" disabled selected>-- Pilih Jenis Prestasi --</option>
                    <option value="1" {{ '1' == old('jenis') ? 'selected' : '' }}>Akademik</option>
                    <option value="2" {{ '2' == old('jenis') ? 'selected' : '' }}>Non-Akademik</option>
                </select>
                @error('jenis')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
            <div class="col-sm-8">
                <textarea type="text" class="form form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                    id="keterangan" required placeholder="Masukkan keterangan prestasi">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
                </label>
            </div>
        </div>
    </div>
</div>
