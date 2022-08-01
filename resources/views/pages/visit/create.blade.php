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
                                <span class="bs-stepper-label">Room & Purpose</span>
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
                        <form class="fs-14 needs-validation" novalidate>
                            <!-- Request -->
                            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                <p class="text-center font-weight-bold fs-16 text-black">Data 1 : Berisikan data diri anggota keluarga</p>
                                <hr>
                                @include('pages.visit.step1')
                            </div>
                            <!-- Room && Purpose -->
                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                <p class="text-center font-weight-bold fs-16 text-black">Data 2 : Berisikan data diri anggota keluarga</p>
                                <hr>
                                @include('pages.visit.step2')
                            </div>
                            <!-- Visitor -->
                            <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                                <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                                <button type="submit" class="btn btn-primary mt-5">Submit</button>
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
    var stepper1

    document.addEventListener('DOMContentLoaded', function() {
        stepper1 = new Stepper(document.querySelector('#stepper1'))
    })
</script>
@endpush
