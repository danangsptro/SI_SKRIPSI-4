@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container-fluid" style="margin-bottom: 100px !important">
    <div class="font-weight-bold text-black">
        <p class="fs-30 mb-0">{{ $title }}</p>
        <span>{{ $desc }}</span>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0">
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
                            <button class="btn btn-success btn-sm mr-2" onclick="pressOnChange()"><i class="fa fa-filter mr-2"></i>Filter</button>
                            <a href="" target="blank" class="btn btn-primary btn-sm" id="exportpdf"><i class="fa fa-print mr-2"></i>Print</a>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-2">
                            <div class="p-2 bg-success text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Disetujui</p>
                                <p class="mb-0 fs-14">{{ $disetujui }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="p-2 bg-warning text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Pending</p>
                                <p class="mb-0 fs-14">{{ $pending }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="p-2 bg-danger text-white rounded text-center">
                                <p class="mb-0 font-weight-bold fs-16 mb-1">Total Ditolak</p>
                                <p class="mb-0 fs-14">{{ $ditolak }}</p>
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
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="15%">Tanggal Request</th>
                            <th width="15%">Tanggal Visit</th>
                            <th width="10%">Jumlah</th>
                            <th width="10%">Status</th>
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
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();

        status_filter = $('#status_filter').val();
        tgl_awal = $('#tgl_awal').val();
        tgl_akhir = $('#tgl_akhir').val();

        params = "?status_filter=" + status_filter + "&tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir;

        url = "{{ route('report.cetakPDF') }}" + params

        $('#exportpdf').attr('href', url)
    }
</script>
@endpush