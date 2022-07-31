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
            <div class="col-md-6 px-0">
                <div class="row mb-2">
                    <label for="status_filter" class="col-form-label col-md-2 text-right font-weight-bolder">Status </label>
                    <div class="col-sm-8">
                        <select class="fs-14 form-control r-0 light" id="status_filter" name="status_filter">
                            <option value="99">Semua</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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
        </div>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Nama</th>
                            <th width="30%">Tanggal</th>
                            <th width="10%">Action</th>
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
    // 
</script>
@endpush