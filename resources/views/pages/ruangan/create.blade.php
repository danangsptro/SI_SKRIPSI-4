@extends('masterBackend')
@section('title', 'DATA | CREATE RUANGAN')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Data Ruangan</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{route('ruangan-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Ruangan</label>
                                <input type="text" class="form-control" placeholder="Masukan nama ruangan"
                                    name="nama_ruangan" required>
                                @error('nama_ruangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jenis Ruangan</label>
                                <input type="text" class="form-control" placeholder="Masukan jenis ruangan"
                                    name="jenis_ruangan" required>
                                @error('jenis_ruangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('ruangan') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
