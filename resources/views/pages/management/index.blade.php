@extends('masterBackend')
@section('title', 'DATA | Ruangan')


@section('backend')
<style>
    .bg-card{
        background: white;
        padding: 1rem;
        border: 2px solid salmon;
        border-radius: 1rem;
    }
</style>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">User Management - Manager</h1>
        <hr>
        <!-- DataTales Example -->
        <a href={{ route('management-create') }} class="btn btn-primary btn-sm">Create Ruangan</a>
        <br>
        <br>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bg-card">
                        <h5><strong>Manager</strong></h5>

                        <br>
                        10
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bg-card">
                        <h5><strong>Admin</strong></h5>

                        <br>
                        20
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bg-card">
                        <h5><strong>Security</strong></h5>

                        <br>
                        30
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bg-card">
                        <h5><strong>Internal Visitor</strong></h5>

                        <br>
                        30
                    </div>
                </div>

            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Register Date</th>
                                <th>Username</th>
                                <th>Validation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->company }}</td>
                                    <td>{{ $item->email }} - {{ $item->contact }} </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <button>Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
