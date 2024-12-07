<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Nama</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror "
                    name="name" id="name" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Gelar</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('gelar') }}" class="form-control @error('gelar') is-invalid @enderror " name="gelar" id="gelar" placeholder="Masukkan gelar">
                @error('gelar')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        {{-- <div class="form-group row">
            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('nip') }}"
                    class="form-control @error('nip') is-invalid @enderror " name="nip" id="nip"
                    placeholder="Masukkan NIP" oninput="validate(this)" >
                @error('nip')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div> --}}
        <div class="form-group row">
            <label for="nuptk" class="col-sm-4 col-form-label">NUPTK</label>
            <div class="col-sm-8">
                <input type="number" value="{{ old('nuptk') }}"
                    class="form-control @error('nuptk') is-invalid @enderror " name="nuptk" id="nuptk"
                    placeholder="Masukkan NUPTK" oninput="validate(this)">
                @error('nuptk')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Jenis Kelamin</label>
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
            <label for="abc" class="col-sm-4 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('tempatlahir') }}" class="form-control @error('tempatlahir') is-invalid @enderror " id="tempatlahir" name="tempatlahir" placeholder="Masukkan tempat lahir">
                @error('tempatlahir')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="date" value="{{ old('tanggallahir') }}" class="form-control @error('tanggallahir') is-invalid @enderror " id="tanggallahir" name="tanggallahir" placeholder="Masukkan tanggal lahir">
                @error('tanggallahir')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label">Telepon</label>
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
            <label for="abc" class="col-sm-4 col-form-label">Alamat</label>
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
            <label for="username" class="col-sm-4 col-form-label">Username</label>
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
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" required>
                @error('password')
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
            <a class="btn btn-danger" href="{{ route('dataguru.index') }}">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</div>

<script>
    function validate(input) {
        if (input.value < 0) {
            input.value = 0;
        } else if (input.value.length > 18) {
            input.value = input.value.slice(0, 18);
        }
    }
</script>
