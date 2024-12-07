<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Nama Mapel</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama Mapel">
                @error('name')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="singkatan" class="col-sm-4 col-form-label">Singkatan Mapel</label>
            <div class="col-sm-8">
                <input type="text" maxlength="10" value="{{ old('singkatan') }}" class="form-control @error('singkatan') is-invalid @enderror " name="singkatan" id="" placeholder="Masukkan singkatan Mapel">
                @error('singkatan')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="kelompok" class="col-sm-4 col-form-label">Kelompok Mapel</label>
            <div class="col-sm-8">
                <select class="form-select @error('kelompok') is-invalid @enderror" name="kelompok" id="">
                    <option value="" disabled selected>-- Pilih Kelompok Mapel --</option>
                    <option value="A" {{ 'A' == old('kelompok') ? 'selected' : '' }}>A</option>
                    <option value="B" {{ 'B' == old('kelompok') ? 'selected' : '' }}>B</option>
                </select>
                @error('tingkat')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="tapel_id" class="col-sm-4 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-8">
                <select class="form-select @error('tapel_id') is-invalid @enderror" name="tapel_id" id="exampleSelectBorder">
                    <option value="" disabled selected>-- Pilih Tapel --</option>
                    @foreach ($tapel as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('tapel_id') ? 'selected' : '' }}>
                            {{ $item->tahun_pelajaran }} - {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}</option>
                    @endforeach
                </select>
                @error('tapel_id')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="offset-sm-4 col-sm-8 mt-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
                </label>
            </div>
        </div>
        <div class="offset-sm-4 col-sm-8 mt-2">
            <a class="btn btn-danger" href="{{ route('datamapel.index') }}">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</div>
