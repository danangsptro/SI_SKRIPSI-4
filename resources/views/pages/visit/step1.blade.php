<div class="row">
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="nama_pengunjung" class="col-sm-3 text-right col-form-label font-weight-bold">Nama Pengunjung <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="nama_pengunjung" id="nama_pengunjung" class="form-control fs-14" placeholder="Nama Pengunjung" autocomplete="off" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="email" class="col-sm-3 text-right col-form-label font-weight-bold">Email <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="email" name="email" id="email" class="form-control fs-14" autocomplete="off" placeholder="contoh@email.com" required>
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
        <div class="row mb-2">
            <label for="no_telp" class="col-sm-3 text-right col-form-label font-weight-bold">No Telp <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="no_telp" id="no_telp" class="form-control fs-14" autocomplete="off" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row mb-2">
            <label for="ktp" class="col-sm-3 text-right col-form-label font-weight-bold">Kartu Pengenal <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file1" name="ktp" required>
                    <label class="custom-file-label fileName1" for="validatedCustomFile">(KTP, ID Card) format (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">KTP tidak boleh kosong</div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="surat_tugas" class="col-sm-3 text-right col-form-label font-weight-bold">Surat Tugas</label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file2" name="surat_tugas">
                    <label class="custom-file-label fileName2" for="validatedCustomFile">format (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">Surat Tugas tidak boleh kosong</div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="surat_izin" class="col-sm-3 text-right col-form-label font-weight-bold">Surat Izin Kerja</label>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file3" name="surat_izin">
                    <label class="custom-file-label fileName3" for="validatedCustomFile">format (pdf, jpeg, jpg, png)</label>
                    <div class="invalid-feedback">Surat Izin Kerja tidak boleh kosong</div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <button type="button" class="btn btn-block btn-success fs-14" onclick="stepper1.next()"><i class="fa fa-arrow-right mr-2"></i>Selanjutya</button>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    for (let index = 1; index <= 3; index++) {
        $('#file'+index).on('change',function(e){
            var fileName = e.target.files[0].name;
            $(this).next('.fileName'+index).html(fileName);
        })
    }

</script>
@endpush
