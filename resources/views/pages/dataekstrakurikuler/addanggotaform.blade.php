<div class="row">
    <div class="col">
        <div class="form-group row">
            <label for="siswa_id" class="col-sm-4 col-form-label">Siswa</label>
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
            <input type="hidden" name="ekstrakurikuler_id" id="" value="{{ $ekstrakurikuler->id }}">
            <label for="ekstrakurikuler_id" class="col-sm-4 col-form-label">Ekstrakurikuler</label>
            <div class="col-sm-8">
                <select disabled aria-readonly="true"
                    class="form-select @error('ekstrakurikuler_id') is-invalid @enderror" name=""
                    id="exampleSelectBorder" required>
                    <option value="{{ $ekstrakurikuler->id }}" selected>{{ $ekstrakurikuler->name }}</option>
                </select>
                @error('ekstrakurikuler_id')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="predikat" class="col-sm-4 col-form-label">Predikat</label>
            <div class="col-sm-8">
                <select aria-readonly="true" class="form-select @error('predikat') is-invalid @enderror" name="predikat"
                    id="exampleSelectBorder">
                    <option value="" disabled selected>-- Pilih Predikat --</option>
                    <option value="A" {{ 'A' == old('predikat') ? 'selected' : '' }}>A (Sangat Baik)</option>
                    <option value="B" {{ 'B' == old('predikat') ? 'selected' : '' }}>B (Baik)</option>
                    <option value="C" {{ 'C' == old('predikat') ? 'selected' : '' }}>C (Cukup)</option>
                    <option value="D" {{ 'D' == old('predikat') ? 'selected' : '' }}>D (Kurang)</option>
                </select>
                @error('predikat')
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
