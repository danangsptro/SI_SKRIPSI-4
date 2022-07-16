@extends('masterBackend')
@section('title', 'DATA | CREATE RUANGAN')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="text-center mb-4">
            <h3><strong>Register User</strong></h3>
        </div>
        <hr>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{route('management-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>FullName</label>
                                <input type="text" class="form-control" placeholder="Example fullname" name="name"
                                    required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Example username" name="username"
                                    required>
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="User@gmail.com" name="email"
                                    required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" placeholder="Example Postiion" name="position"
                                    required>
                                @error('position')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" class="form-control" placeholder="Pt.Company name" name="company"
                                    required>
                                @error('company')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" placeholder="0812xxxxxx" name="contact" required>
                                @error('contact')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="status" required>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('management') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
