<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Kelas</label>
            <div class="col-sm-8">
                <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" id="exampleSelectBorder">
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('kelas_id') ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <select class="form-select @error('jk') is-invalid @enderror" name="jk" id="">
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ 'L' == old('jk') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ 'P' == old('jk') ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jk')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Jenis Pendaftaran</label>
            <div class="col-sm-8">
                <select class="form-select @error('jenispendaftaran') is-invalid @enderror" name="jenispendaftaran" id="">
                    <option value="" disabled selected>-- Pilih Jenis Pendaftaran --</option>
                    <option value="1" {{ '1' == old('jenispendaftaran') ? 'selected' : '' }}>Siswa Baru</option>
                    <option value="2" {{ '2' == old('jenispendaftaran') ? 'selected' : '' }}>Pindahan</option>
                </select>
                @error('jenispendaftaran')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Diterima Pada</label>
            <div class="col-sm-8">
                <input type="date" value="{{ old('diterimapada') }}" class="form-control @error('diterimapada') is-invalid @enderror " name="diterimapada" id="diterimapada" placeholder="Masukkan diterima pada">
                @error('diterimapada')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">NIS</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('nis') }}" class="form-control @error('nis') is-invalid @enderror " id="nis" name="nis" placeholder="Masukkan NIS" oninput="validateNis(this)">
                @error('nis')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">NISN</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('nisn') }}" class="form-control @error('nisn') is-invalid @enderror " id="nisn" name="nisn" placeholder="Masukkan NISN" oninput="validateNisn(this)">
                @error('nisn')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('tempatlahir') }}" class="form-control @error('tempatlahir') is-invalid @enderror " id="tempatlahir" name="tempatlahir" placeholder="Masukkan tempatlahir">
                @error('tempatlahir')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="date" value="{{ old('tanggallahir') }}" class="form-control @error('tanggallahir') is-invalid @enderror " id="tanggallahir" name="tanggallahir" placeholder="Masukkan tanggal lahir">
                @error('tanggallahir')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-8">
                <select class="form-select @error('agama') is-invalid @enderror" name="agama" id="">
                    <option value="" disabled selected>-- Pilih Agama --</option>
                    <option value="1" {{ '1' == old('agama') ? 'selected' : '' }}>Islam</option>
                    <option value="2" {{ '2' == old('agama') ? 'selected' : '' }}>Protestan</option>
                    <option value="3" {{ '3' == old('agama') ? 'selected' : '' }}>Katolik</option>
                    <option value="4" {{ '4' == old('agama') ? 'selected' : '' }}>Hindu</option>
                    <option value="5" {{ '5' == old('agama') ? 'selected' : '' }}>Nuddha</option>
                </select>
                @error('agama')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Status Dalam Keluarga</label>
            <div class="col-sm-8">
                <select class="form-select @error('jk') is-invalid @enderror" name="statusdalamkeluarga" id="">
                    <option value="" disabled selected>-- Pilih Status Dalam Keluarga --</option>
                    <option value="1" {{ 1 == old('statusdalamkeluarga') ? 'selected' : '' }}>Anak Kandung
                    </option>
                    <option value="2" {{ 2 == old('statusdalamkeluarga') ? 'selected' : '' }}>Anak Angkat
                    </option>
                </select>
                @error('statusdalamkeluarga')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Anak ke</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('anak_ke') }}" class="form-control @error('anak_ke') is-invalid @enderror " id="anak_ke" name="anak_ke" placeholder="Masukkan anak ke">
                @error('anak_ke')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror " name="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Telepon</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('telepon') }}" class="form-control @error('telepon') is-invalid @enderror " name="telepon" placeholder="Masukkan telepon">
                @error('telepon')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Nama Ayah</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('namaayah') }}" class="form-control @error('namaayah') is-invalid @enderror " id="namaayah" placeholder="Masukkan nama ayah" name="namaayah">
                @error('namaayah')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('pekerjaanayah') }}" class="form-control @error('pekerjaanayah') is-invalid @enderror " id="pekerjaanayah" placeholder="Masukkan pekerjaan ayah" name="pekerjaanayah">
                @error('pekerjaanayah')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Nama Ibu</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('namaibu') }}" class="form-control @error('namaibu') is-invalid @enderror " id="namaibu" placeholder="Masukkan nama ibu" name="namaibu">
                @error('namaibu')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('pekerjaanibu') }}" class="form-control @error('pekerjaanibu') is-invalid @enderror " id="pekerjaanibu" placeholder="Masukkan pekerjaan ibu" name="pekerjaanibu">
                @error('pekerjaanibu')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Nama Wali</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('namawali') }}" class="form-control @error('namawali') is-invalid @enderror " id="namawali" placeholder="Masukkan nama wali" name="namawali">
                @error('namawali')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Pekerjaan Wali</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('pekerjaanwali') }}" class="form-control @error('pekerjaanwali') is-invalid @enderror " id="pekerjaanwali" placeholder="Masukkan pekerjaan wali" name="pekerjaanwali">
                @error('pekerjaanwali')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror " name="username" placeholder="Masukkan username" required>
                @error('username')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Masukkan password" required>
                @error('password')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <input type="hidden" name="user_id" id="" value="1">

    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-6">
        <div class="form-group row">
            <div class="offset-sm-6 col-sm-6">
                <a class="btn btn-danger" href="{{ route('datasiswa.index', $role) }}">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function validateNis(input) {
        if (input.value < 0) {
            input.value = 0;
        } else if (input.value.length > 8) {
            input.value = input.value.slice(0, 8);
        }
    }
    function validateNisn(input) {
        if (input.value < 0) {
            input.value = 0;
        } else if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
</script>