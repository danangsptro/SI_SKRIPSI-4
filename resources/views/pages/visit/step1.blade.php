<div class="row">
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="nama_pengunjung" class="col-sm-3 text-right col-form-label font-weight-bold">Nama Pengunjung <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama_pengunjung" id="nama_pengunjung" class="form-control fs-14" placeholder="Nama Pengunjung" autocomplete="off" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="perusahaan" class="col-sm-3 text-right col-form-label font-weight-bold">Perusahaan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="perusahaan" id="perusahaan" class="form-control fs-14" autocomplete="off" placeholder="Masukan Nama Perusahaan" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="jabatan" class="col-sm-3 text-right col-form-label font-weight-bold">Jabatan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="jabatan" id="jabatan" class="form-control fs-14" autocomplete="off" placeholder="Jabatan Pengunjung" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="no_telp" class="col-sm-3 text-right col-form-label font-weight-bold">No Telp <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="no_telp" id="no_telp" class="form-control fs-14" autocomplete="off" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>
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
        <div class="row mt-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <button class="btn btn-block btn-success fs-14" onclick="stepper1.next()"><i class="fa fa-arrow-right mr-2"></i>Selanjutya</button>
            </div>
        </div>
    </div>
</div>