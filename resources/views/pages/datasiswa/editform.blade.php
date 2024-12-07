<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('name', $siswa->name) }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama lengkap" required>
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
                        <option value="{{ $item->id }}" {{ $siswa->kelas->id == $item->id ? 'selected' : '' }}>
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
                    <option value="L" {{ $siswa->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $siswa->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                    <option value="1" {{ $siswa->jenispendaftaran == '1' ? 'selected' : '' }}>Siswa Baru</option>
                    <option value="2" {{ $siswa->jenispendaftaran == '2' ? 'selected' : '' }}>Pindahan</option>
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
                <input type="date" value="{{ old('diterimapada', $siswa->diterimapada) }}" class="form-control @error('diterimapada') is-invalid @enderror " name="diterimapada" id="diterimapada" placeholder="Masukkan diterima pada">
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
                <input type="number" value="{{ old('nis', $siswa->nis) }}" class="form-control @error('nis') is-invalid @enderror " id="nis" name="nis" placeholder="Masukkan NIS" oninput="validateNis(this)">
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
                <input type="number" value="{{ old('nisn', $siswa->nisn) }}" class="form-control @error('nisn') is-invalid @enderror " id="nisn" name="nisn" placeholder="Masukkan NISN" oninput="validateNisn(this)">
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
                <input type="text" value="{{ old('tempatlahir', $siswa->tempatlahir) }}" class="form-control @error('tempatlahir') is-invalid @enderror " id="tempatlahir" name="tempatlahir" placeholder="Masukkan tempatlahir">
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
                <input type="date" value="{{ old('tanggallahir', $siswa->tanggallahir) }}" class="form-control @error('tanggallahir') is-invalid @enderror " id="tanggallahir" name="tanggallahir" placeholder="Masukkan tanggallahir">
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
                    <option value="1" {{ $siswa->agama == '1' ? 'selected' : '' }}>Islam</option>
                    <option value="2" {{ $siswa->agama == '2' ? 'selected' : '' }}>Protestan</option>
                    <option value="3" {{ $siswa->agama == '3' ? 'selected' : '' }}>Katolik</option>
                    <option value="4" {{ $siswa->agama == '4' ? 'selected' : '' }}>Hindu</option>
                    <option value="5" {{ $siswa->agama == '5' ? 'selected' : '' }}>Nuddha</option>
                </select>
                @error('agama')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status Siswa</label>
            <div class="col-sm-8">
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="">
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="1" {{ $siswa->status == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ $siswa->status == '2' ? 'selected' : '' }}>Keluar</option>
                    <option value="3" {{ $siswa->status == '3' ? 'selected' : '' }}>Lulus</option>
                </select>
                @error('status')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Status Dalam Keluarga</label>
            <div class="col-sm-8">
                <select class="form-select @error('jk') is-invalid @enderror" name="statusdalamkeluarga" id="">
                    <option value="" disabled selected>-- Pilih Status Dalam Keluarga --</option>
                    <option value="1" {{ $siswa->statusdalamkeluarga == '1' ? 'selected' : '' }}>Anak Kandung
                    </option>
                    <option value="2" {{ $siswa->statusdalamkeluarga == '2' ? 'selected' : '' }}>Anak Angkat
                    </option>
                    <option value="2" {{ $siswa->statusdalamkeluarga == '3' ? 'selected' : '' }}>Anak Tiri
                    </option>
                </select>
                @error('statusdalamkeluarga')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-3 col-form-label">Anak ke</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('anak_ke', $siswa->anak_ke) }}" class="form-control @error('anak_ke') is-invalid @enderror " id="anak_ke" name="anak_ke" placeholder="Masukkan anak ke">
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
                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror " name="alamat" placeholder="Masukkan alamat">{{ old('alamat', $siswa->alamat) }}</textarea>
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
                <input type="text" maxlength="12" value="{{ old('telepon', $siswa->telepon) }}" class="form-control @error('telepon') is-invalid @enderror " name="telepon" placeholder="Masukkan telepon">
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
                <input type="text" value="{{ old('namaayah', $siswa->namaayah) }}" class="form-control @error('namaayah') is-invalid @enderror " id="namaayah" placeholder="Masukkan nama ayah" name="namaayah">
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
                <input type="text" value="{{ old('pekerjaanayah', $siswa->pekerjaanayah) }}" class="form-control @error('pekerjaanayah') is-invalid @enderror " id="pekerjaanayah" placeholder="Masukkan pekerjaan ayah" name="pekerjaanayah">
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
                <input type="text" value="{{ old('namaibu', $siswa->namaibu) }}" class="form-control @error('namaibu') is-invalid @enderror " id="namaibu" placeholder="Masukkan nama ibu" name="namaibu">
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
                <input type="text" value="{{ old('pekerjaanibu', $siswa->pekerjaanibu) }}" class="form-control @error('pekerjaanibu') is-invalid @enderror " id="pekerjaanibu" placeholder="Masukkan pekerjaan ibu" name="pekerjaanibu">
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
                <input type="text" value="{{ old('namawali', $siswa->namawali) }}" class="form-control @error('namawali') is-invalid @enderror " id="namawali" placeholder="Masukkan nama wali" name="namawali">
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
                <input type="text" value="{{ old('pekerjaanwali', $siswa->pekerjaanwali) }}" class="form-control @error('pekerjaanwali') is-invalid @enderror " id="pekerjaanwali" placeholder="Masukkan pekerjaan wali" name="pekerjaanwali">
                @error('pekerjaanwali')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        {{-- <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('username', $siswa->abc) }}" class="form-control @error('username') is-invalid @enderror " name="username" placeholder="Masukkan username">
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
                <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Masukkan password">
                @error('password')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div> --}}

        <input type="hidden" name="user_id" id="" value="{{ $siswa->user->id }}">

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