<div class="row">
    <div class="col">
  
      <div class="form-group row">
        <label for="judul" class="col-sm-4 col-form-label">Judul Informasi</label>
        <div class="col-sm-8">
          <input type="text" value="{{ old('judul') }}" class="form form-control @error('judul') is-invalid @enderror" name="judul" id="judul" required placeholder="Masukkan judul informasi">
          @error('judul')
          <span class="invalid-feedback mt-1">
            {{ $message }}
          </span>
          @enderror
        </div>
      </div>
  
      <div class="form-group row">
        <label for="untuk" class="col-sm-4 col-form-label">Informasi Untuk</label>
        <div class="col-sm-8">
          <select aria-readonly="true" class="form-select @error('untuk') is-invalid @enderror" name="untuk" id="exampleSelectBorder" required>
              <option value="" disabled selected>-- Pilih --</option>
              <option value="admin" {{ 'admin' == old('untuk') ? 'selected' : '' }}>Administrator</option>
              <option value="guru" {{ 'guru' == old('untuk') ? 'selected' : '' }}>Guru</option>
              {{-- <option value="walisiswa" {{ 'walisiswa' == old('untuk') ? 'selected' : '' }}>Wali Siswa</option> --}}
              <option value="siswa" {{ 'siswa' == old('untuk') ? 'selected' : '' }}>Siswa</option>
          </select>
          @error('jenis')
          <span class="invalid-feedback mt-1">
            {{ $message }}
          </span>
          @enderror
        </div>
      </div>
  
      <div class="form-group row">
        <label for="isi" class="col-sm-4 col-form-label">Isi</label>
        <div class="col-sm-8">
          <textarea type="text" class="form form-control @error('isi') is-invalid @enderror" name="isi" id="isi" required placeholder="Masukkan isi informasi">{{ old('isi') }}</textarea>
          @error('isi')
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
  