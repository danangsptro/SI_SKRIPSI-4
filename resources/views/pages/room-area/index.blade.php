@extends('masterBackend')
@section('title', 'DATA | ROOM-AREA')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Area</h1>
        <hr>
        <!-- DataTales Example -->
        <a href={{ route('area-create') }} class="btn btn-primary btn-sm">Add New</a>
        <br>
        <br>

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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->status === 'Active')
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('area-room-edit', $item->id) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('area-room-delete', $item->id) }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-circle"
                                                onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
