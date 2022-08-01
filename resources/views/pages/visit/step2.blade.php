<div class="row">
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="ktp" class="col-sm-3 text-right col-form-label font-weight-bold">KTP <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="ktp" name="ktp" required>
                    <label class="custom-file-label" for="validatedCustomFile">Pilih File (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">KTP tidak boleh kosong</div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="surat_tugas" class="col-sm-3 text-right col-form-label font-weight-bold">Surat Tugas <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="surat_tugas" name="surat_tugas" required>
                    <label class="custom-file-label" for="validatedCustomFile">Pilih File (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">Surat Tugas tidak boleh kosong</div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="surat_izin" class="col-sm-3 text-right col-form-label font-weight-bold">Surat Izin Kerja <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="surat_izin" name="surat_izin" required>
                    <label class="custom-file-label" for="validatedCustomFile">Pilih File (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">Surat Izin Kerja tidak boleh kosong</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="surat_tugas" class="col-sm-3 text-right col-form-label font-weight-bold">Ruangan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="row ml-0">
                    @foreach ($rooms as $i)
                    <div class="mt-2 ml-4 mr-4">
                        <input type="checkbox" name="room_id[]" id="room_id" value="{{ $i->id }}" class="form-check-input" required>
                        <label class="form-check-label">
                            {{ $i->nama }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="surat_tugas" class="col-sm-3 text-right col-form-label font-weight-bold">Tujuan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="row ml-0">
                    @foreach ($purposes as $i)
                    <div class="mt-2 ml-4 mr-4">
                        <input type="radio" name="room_id[]" id="room_id" value="{{ $i->id }}" class="form-check-input" required>
                        <label class="form-check-label">
                            {{ $i->tujuan }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="ket" class="col-sm-3 text-right col-form-label font-weight-bold">Catatan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <textarea type="text" name="ket" id="ket" class="form-control fs-14" placeholder="Masukan Catatan" autocomplete="off" required></textarea>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <button class="btn btn-block btn-danger fs-14" onclick="stepper1.previous()"><i class="fa fa-arrow-left mr-2"></i>Sebelumnya</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-success fs-14" onclick="stepper1.next()"><i class="fa fa-arrow-right mr-2"></i>Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>