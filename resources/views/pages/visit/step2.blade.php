<div class="row">
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="surat_tugas" class="col-sm-3 text-right col-form-label font-weight-bold">Ruangan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="row ml-0">
                    @foreach ($rooms as $i)
                    <div class="mt-2 ml-4 mr-4">
                        <input type="checkbox" name="room_id[]" id="room_id" value="{{ $i->id }}" class="form-check-input">
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
                        <input type="radio" name="purpose_id" id="purpose_id" value="{{ $i->id }}" class="form-check-input" required>
                        <label class="form-check-label">
                            {{ $i->tujuan }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="ket" class="col-sm-3 text-right col-form-label font-weight-bold">Catatan</label>
            <div class="col-sm-9">
              <textarea type="text" name="ket" id="ket" class="form-control fs-14" rows="3" placeholder="Masukan Catatan" autocomplete="off"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="tanggal" class="col-sm-3 text-right col-form-label font-weight-bold">Tanggal <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="date" name="tanggal" id="tanggal" class="form-control fs-14" autocomplete="off" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="waktu" class="col-sm-3 text-right col-form-label font-weight-bold">Jam <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="time" name="waktu" id="waktu" class="form-control fs-14" autocomplete="off" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <button type="button" class="btn btn-block btn-danger fs-14" onclick="stepper1.previous()"><i class="fa fa-arrow-left mr-2"></i>Sebelumnya</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-success fs-14" onclick="stepper1.next()"><i class="fa fa-arrow-right mr-2"></i>Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>