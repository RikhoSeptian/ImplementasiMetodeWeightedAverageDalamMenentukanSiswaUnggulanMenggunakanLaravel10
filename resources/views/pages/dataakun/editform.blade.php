<div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-8">
        <input type="text"
            value="
            @php
                if ($akun->role == 'admin') {
                    echo $akun->admin->name . ' - Administrator';
                } elseif ($akun->role == 'guru') {
                    echo $akun->guru->name . ' - Guru';
                } elseif ($akun->role == 'walisiswa') {
                    echo $akun->walisiswa->name . ' - Wali Siswa';
                } else {
                    echo $akun->siswa->name . ' - ' . $akun->siswa->kelas->name;
                }
            @endphp" class="form-control" placeholder="Masukkan username" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-8">
        <input type="text" value="{{ old('username', $akun->username) }}"
            class="form-control @error('username') is-invalid @enderror " name="username"
            placeholder="Masukkan username">
        @error('username')
            <span class="invalid-feedback mt-1">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Email <small>(Opsional)</small> </label>
    <div class="col-sm-8">
        <input type="email" value="{{ old('email', $akun->email) }}"
            class="form-control @error('email') is-invalid @enderror " name="email" placeholder="Masukkan email">
        @error('email')
            <span class="invalid-feedback mt-1">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">Password <small>(opsional)</small></label>
    <div class="col-sm-8">
        <input type="password" class="form-control @error('password') is-invalid @enderror " name="password"
            placeholder="Masukkan password baru">
        @error('password')
            <span class="invalid-feedback mt-1">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="offset-sm-3 col-sm-8 mt-4">
    <div class="checkbox">
        <label>
            <input type="checkbox" required> Saya yakin akan mengubah data tersebut
        </label>
    </div>
</div>
<div class="offset-sm-3 col-sm-8 mt-2">
    <a class="btn btn-danger" href="{{ route('dataakun.index') }}">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>
