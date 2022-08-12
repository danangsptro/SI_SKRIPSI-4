<div class="my-2">
    <button type="button" class="btn btn-sm btn-success" id="dynamic-ar"><i class="fa fa-plus mr-2"></i>Tambah</button>
</div>
<table class="table table-bordered" id="dynamicAddRemove">
    <tr>
        <th width="20%">Nama</th>
        <th width="20%">Jabatan <button type="button" class="btn btn-sm btn-primary float-right" onclick="jabatanSama()">sama</button></th>
        <th width="23%">KTP</th>
        <th width="20%">Perusahaan <button type="button" class="btn btn-sm btn-primary float-right" onclick="perusahaanSama()">sama</button></th>
        <th width="7%"></th>
    </tr>
    <tr>
        <td>
            <input type="text" name="nama_visitor[]" placeholder="Masukan Nama" class="form-control fs-14">
        </td>
        <td>
            <input type="text" name="jabatan_visitor[]" placeholder="Masukan Jabatan" class="form-control fs-14">
        </td>
        <td>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file_visitor1" value="" name="ktp_visitor[]" accept="image/png, image/gif, image/jpeg">
                <label class="custom-file-label fileNameVisitor1" for="validatedCustomFile">Pilih File (pdf, jpeg, jpg, png)</label>
            </div>
        </td>
        <td>
            <input type="text" name="perusahaan_visitor[]" placeholder="Masukan Perusahaan" class="form-control fs-14">
        </td>
        <td>
            {{--  --}}
        </td>
    </tr>
</table>
@push('script')
<script type="text/javascript">
    // Dinamis Add remove
    var i = 1;
    $("#dynamic-ar").click(function () {
        i++;
        $("#dynamicAddRemove").append(
            `<tr>
                <td>
                    <input type="text" name="nama_visitor[]" placeholder="Masukan Nama" class="form-control fs-14">
                </td>
                <td>
                    <input type="text" name="jabatan_visitor[]" placeholder="Masukan Jabatan" class="form-control fs-14">
                </td>
                <td>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_visitor${i}" value="" name="ktp_visitor[]" accept="image/png, image/gif, image/jpeg">
                        <label class="custom-file-label fileNameVisitor${i}" for="validatedCustomFile">Pilih File (pdf, jpeg, jpg, png)</label>
                    </div>
                </td>
                <td>
                    <input type="text" name="perusahaan_visitor[]" placeholder="Masukan Perusahaan" class="form-control fs-14">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-input-field"><i class="fa fa-trash mr-2"></i>Hapus</button>
                </td>
            </tr>`
        );
        $('#file_visitor'+i).on('change',function(e){
            var fileName = e.target.files[0].name;
            $(this).next('.fileNameVisitor'+i).html(fileName);
        })
    });

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    function perusahaanSama(){
        perusahaan = $('#perusahaan').val();

        $('input[name="perusahaan_visitor[]"]').each(function(){
            $(this).val(perusahaan);
        })
    }

    function jabatanSama(){
        perusahaan = $('#jabatan').val();

        $('input[name="jabatan_visitor[]"]').each(function(){
            $(this).val(perusahaan);
        })
    }

   
    $('#file_visitor1').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.fileNameVisitor1').html(fileName);
    })


</script>
@endpush