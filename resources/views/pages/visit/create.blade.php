@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container-fluid">
    <div class="card my-4">
        <h5 class="card-header bg-primary text-white font-weight-bold">Tambah Visit</h5>
        <div class="card-body">
            <div id="alert"></div>
            <div id="stepper1" class="bs-stepper">
                <div class="bs-stepper-header mb-4 rounded" role="tablist" style="background: #F2F2F2">
                    <div class="step" data-target="#test-l-1">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">Request</span>
                        </button>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Room</span>
                        </button>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-3">
                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">Visitor</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form id="form" class="fs-14 needs-validation" novalidate method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Request -->
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <p class="text-center font-weight-bold fs-16 text-black">Berisikan data perwakilan pengunjung </p>
                            <hr>
                            @include('pages.visit.step1')
                        </div>
                        <!-- Room && Purpose -->
                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                            <p class="text-center font-weight-bold fs-16 text-black">Berisikan data ruangan dan tujuan berkunjung</p>
                            <hr>
                            @include('pages.visit.step2')
                        </div>
                        <!-- Visitor -->
                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                            <p class="text-center font-weight-bold fs-16 text-black">Berisikan data diri para pengunjung</p>
                            <hr>
                            @include('pages.visit.step3')
                            <div class="container col-md-3">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <button type="button" class="btn btn-block btn-danger fs-14" onclick="stepper1.previous()"><i class="fa fa-arrow-left mr-2"></i>Sebelumnya</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-block btn-success fs-14" data-toggle="modal" data-target="#modalForm"><i class="fa fa-arrow-right mr-2"></i>Selanjutnya</button>
                                    </div>
                                    <button class="d-none" type="submit" id="buttonForm"></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fs-18">Syarat dan Ketentuan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{ asset('images/agreement.jpeg') }}" class="img-fluid" alt="">
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Batalkan</button>
                        <button class="btn btn-sm btn-success fs-14" onclick="triggerFromButton()"><i class="fa fa-save mr-2"></i>Simpan Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    // Stepper
    var stepper1
    document.addEventListener('DOMContentLoaded', function() {
        stepper1 = new Stepper(document.querySelector('#stepper1'))
    })

    function triggerFromButton(){
        $("#buttonForm").trigger("click");
    }

    // Store
    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            $.confirm({
                title: 'Error',
                content: 'Lengkap form dengan benar',
                icon: 'bi bi-patch-exclamation-fill',
                theme: 'modern',
                closeIcon: true,
                animation: 'scale',
                autoClose: 'ok|5000',
                type: 'red',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn btn-sm btn-primary',
                        keys: ['enter']
                    }
                }
            });
        }
        else{
            $('#alert').html('');
            url = "{{ route('visit.store') }}";
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#form').removeClass('was-validated');
                    $('#modalForm').modal('toggle');
                    $.confirm({
                        title: 'Success',
                        content: data.message,
                        icon: 'icon icon-check', 
                        theme: 'modern',
                        animation: 'scale',
                        autoClose: 'ok|3000',
                        type: 'green',
                        buttons: {
                            ok: {
                                text: "ok!",
                                btnClass: 'btn-sm btn-success',
                                keys: ['enter'],
                                action: function () {
                                    window.location.href = "{{ route('visit.index') }}";
                                }
                            }
                        }
                    });
                },
                error : function(data){ 
                    $('#modalForm').modal('toggle');
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible fs-14'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                }
            });
            return false;
        }
    });

</script>
@endpush
