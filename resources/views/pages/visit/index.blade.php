@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container-fluid" style="margin-bottom: 100px !important">
    <div class="font-weight-bold text-black">
        <p class="fs-30 mb-0">{{ $title }}</p>
        <span>{{ $desc }}</span>
    </div>
    <div class="mt-4 text-right">
        <a href="{{ route('visit.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
    </div> 
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0 container">
                    <div class="row mb-2">
                        <label for="status_filter" class="col-form-label col-md-2 text-right font-weight-bolder fs-14">Status </label>
                        <div class="col-sm-8">
                            <select class="fs-14 form-control fs-14 r-0 light" id="status_filter" name="status_filter">
                                <option value="99">Semua</option>
                                <option value="0">Pending</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-form-label col-md-2 text-right font-weight-bolder fs-14">Tanggal </label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="date" placeholder="MM/DD/YYYY" value="" name="tgl_awal" id="tgl_awal" class="form-control fs-14" autocomplete="off"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" placeholder="MM/DD/YYYY" value="" name="tgl_akhir" id="tgl_akhir" class="form-control fs-14" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm" onclick="pressOnChange()"><i class="fa fa-filter mr-2"></i>Filter</button>
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
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="15%">Tanggal Request</th>
                            <th width="15%">Tanggal Visit</th>
                            <th width="10%">Jumlah</th>
                            <th width="10%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                </table>
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
            url: "{{ route('visit.index') }}",
            method: 'GET',
            data: function (data) {
                data.status_filter = $('#status_filter').val();
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama_pengunjung', name: 'nama_pengunjung'},
            {data: 'email', name: 'email'},
            {data: 'tgl_request', name: 'tgl_request'},
            {data: 'tgl_visit', name: 'tgl_visit'},
            {data: 'jumlah', name: 'jumlah'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }

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
                        $.post("{{ route('visit.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
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