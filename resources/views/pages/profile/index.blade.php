@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container-fluid">
    <div class="font-weight-bold text-black">
        <p class="fs-30 mb-0">{{ $title }}</p>
        <span>{{ $desc }}</span>
    </div>
    <div class="mt-4">
        @include('layouts.alert')
        <div class="row">
            <div class="col-sm-5 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="rounded-circle" width="130" src="{{ asset('assets/img/undraw_profile.svg') }}">
                            <div class="mt-3">
                                <h4 class="text-black font-weight-bold">{{ $data->nama }}</h4>
                                <p>Pegawai Perusahaan <span class="font-weight-bold">{{ $data->perusahaan }}</span></p>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-sm btn-danger" onclick="openModalResetPassword()"><i class="fa fa-key mr-2"></i>Ganti Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <h5 class="card-header fs-18 font-weight-bold text-white bg-primary">Edit Profile</h5>
                    <div class="card-body">
                        <form action="{{ route("profile.update", Auth::user()->id) }}" class="fs-14 needs-validation" novalidate method="post">
                            @csrf
                            <div>
                                <label for="nama" class="form-label font-weight-bold">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ $data->nama }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="perusahaan" class="form-label font-weight-bold">Perusahaan</label>
                                <input type="text" name="perusahaan" id="perusahaan" value="{{ $data->perusahaan }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="departemen" class="form-label font-weight-bold">Departemen</label>
                                <input type="text" name="departemen" id="departemen" value="{{ $data->departemen }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="jabatan" class="form-label font-weight-bold">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ $data->jabatan }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="no_telp" class="form-label font-weight-bold">No Telp</label>
                                <input type="text" name="no_telp" id="no_telp" value="{{ $data->no_telp }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="role_id" class="form-label font-weight-bold">Role</label>
                                <input type="email" readonly name="role_id" id="role_id" value="{{ $data->role->nama }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-2">
                                <label for="email" class="form-label font-weight-bold">Email</label>
                                <input type="email" readonly name="email" id="email" value="{{ $data->email }}" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-redo mr-2"></i>Perbarui Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fs-18">Ganti Password</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.updatePassword', Auth::user()->id) }}" class="fs-14 needs-validation" novalidate method="post">
                    @csrf
                    <div>
                        <label for="password" class="form-label font-weight-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" required/>
                    </div>
                    <div class="mt-2">
                        <label for="confirm_password" class="form-label font-weight-bold">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off" required/>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-redo mr-2"></i>Perbarui Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    function openModalResetPassword(){
        $('#modalForm').modal('show');
    }
</script>
@endpush