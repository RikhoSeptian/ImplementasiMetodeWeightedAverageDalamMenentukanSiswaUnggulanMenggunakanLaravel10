<div class="row">
    <div class="col">
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Ekstrakurikuler</label>
            <div class="col-sm-8">
                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror "
                    name="name" id="" placeholder="Masukkan Nama Ekstrakurikuler" required>
                @error('name')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="guru_id" class="col-sm-4 col-form-label">Pembina</label>
            <div class="col-sm-8">
                <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id"
                    id="exampleSelectBorder" required>
                    <option value="" disabled selected>-- Pilih Pembina --</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('guru_id') ? 'selected' : '' }}>
                            {{ $item->name }}{{ $item->gelar ? ', ' . $item->gelar : '' }}</option>
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
            <label for="tapel_id" class="col-sm-4 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-8">
                <select class="form-select @error('tapel_id') is-invalid @enderror" name="tapel_id"
                    id="exampleSelectBorder" required>
                    <option value="" disabled selected>-- Pilih Tapel --</option>
                    @foreach ($tapel as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('tapel_id') ? 'selected' : '' }}>
                            {{ $item->tahun_pelajaran }}{{ $item->semester == 1 ? ' - Ganjil' : ' - Genap' }}</option>
                    @endforeach
                </select>
                @error('tapel_id')
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