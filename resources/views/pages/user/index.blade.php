@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="font-weight-bold text-black">
        <p class="fs-30 mb-0">{{ $title }}</p>
        <span>{{ $desc }}</span>
    </div>
    <div class="mt-4 text-right">
        <a href="#" onclick="add()" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
    </div>  
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0">
                    <div class="row mb-2">
                        <label for="role_id_filter" class="col-form-label col-md-2 text-right font-weight-bolder">Role </label>
                        <div class="col-sm-8">
                            <select class="fs-14 form-control fs-14 r-0 light" id="role_id_filter" name="role_id_filter">
                                <option value="0">Semua</option>
                                @foreach ($roles as $i)
                                    <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm" onclick="pressOnChange()"><i class="fa fa-filter mr-2"></i>Filter</button>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="p-2 bg-success text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Admin</p>
                                <p class="mb-0 fs-14">{{ $admin }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="p-2 bg-info text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Manager</p>
                                <p class="mb-0 fs-14">{{ $manager }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="p-2 bg-warning text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Staff</p>
                                <p class="mb-0 fs-14">{{ $staff }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-2 bg-primary text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Security</p>
                                <p class="mb-0 fs-14">{{ $security }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fs-18"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="fs-14 needs-validation" novalidate>
                    {{ method_field('POST') }}
                    <input type="text" class="d-none" id="id" name="id"/>
                    <div id="alert"></div>
                    <div class="row mb-2">
                        <label for="role_id" class="col-sm-3 col-form-label font-weight-bold">Role <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select fs-14 select2" name="role_id" id="role_id">
                                <option value="">Pilih</option>
                                @foreach ($roles as $i)
                                    <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="col-sm-3 col-form-label font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="nama" id="nama" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="email" name="email" id="email" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="no_telp" class="col-sm-3 col-form-label font-weight-bold">No Telp <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" name="no_telp" id="no_telp" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="perusahaan" class="col-sm-3 col-form-label font-weight-bold">Perusahaan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="perusahaan" id="perusahaan" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="departemen" class="col-sm-3 col-form-label font-weight-bold">Departemen <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="departemen" id="departemen" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="jabatan" class="col-sm-3 col-form-label font-weight-bold">Jabatan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="jabatan" id="jabatan" class="form-control fs-14" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-success fs-14" id="btnSave" title="Simpan Data"><i class="bi bi-save m-r-8"></i>Simpan <span id="txtSave"></span></button>
                            <a href="#" onclick="add()" class="m-l-5 text-danger font-weight-bold  fs-14" title="Kosongkan Form"><i class="bi bi-arrow-clockwise m-r-8"></i>Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route('user.index') }}",
            method: 'GET',
            data: function (data) {
                data.role_id_filter = $('#role_id_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'perusahaan', name: 'perusahaan'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'role_id', name: 'role_id'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }

    $('.select2').select2({
        dropdownParent: $('#modalForm')
    });

    function add(){
        openForm();
        save_method = "add";
        $('#form').trigger('reset');
        $('input[name=_method]').val('POST');
        $('#txtTitle').html('Tambah');
        $('#txtSave').html('');
        $('#alert').html('');
    }

    function edit(id){
        $('#loading').show();
        $.get("{{ Route('user.edit', ':id') }}".replace(':id', id), function(data){
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#email').val(data.email);
            $('#perusahaan').val(data.perusahaan);
            $('#departemen').val(data.departemen);
            $('#jabatan').val(data.jabatan);
            $('#no_telp').val(data.no_telp);
            $('#role_id').val(data.role_id).trigger("change.select2");
        });
    }

    $('#form').on('submit', function (event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            $('#loading').show();
            $('#alert').html('');
            $('#btnSave').attr('disabled', true);
            
            url = (save_method == 'add') ? "{{ route('user.store') }}" : "{{ route('user.update', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                table.api().ajax.reload();
                if(save_method == 'add') $('#form').trigger('reset');
            },'json').fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div class='alert alert-danger alert-dismissible' role='alert'>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function(){
                $('#loading').hide();
                $('#btnSave').removeAttr('disabled');
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

    function remove(id){
        $.confirm({
            title: 'Konfirmasi',
            content: 'Apakah Anda yakin ingin menghapus data ini ?',
            icon: 'bi bi-question text-danger',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route('user.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
                            table.api().ajax.reload();
                            success(data.message)
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){}
            }
        });
    }
</script>
@endpush