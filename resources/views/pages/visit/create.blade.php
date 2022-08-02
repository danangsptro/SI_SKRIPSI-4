@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card my-4">
            <h5 class="card-header bg-primary text-white font-weight-bold">Tambah Visit</h5>
            <div class="card-body">
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
                        <form action="{{ route('visit.store') }}" class="fs-14 needs-validation" novalidate method="POST">
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
                                            <button type="submit" class="btn btn-block btn-success fs-14"><i class="fa fa-save mr-2"></i>Simpan Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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

</script>
@endpush
