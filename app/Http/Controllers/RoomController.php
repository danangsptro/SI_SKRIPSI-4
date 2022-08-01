<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Room;

class RoomController extends Controller
{
    protected $title = 'Room';
    protected $pages = 'pages.room.';
    protected $desc  = 'Menu ini berisikan data Room';

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;

        //* DataTable
        $status = $request->status_filter;
        if ($request->ajax()) {
            return $this->dataTable($status);
        }

        return view($this->pages . 'index', compact(
            'title',
            'desc'
        ));
    }

    public function dataTable($status)
    {
        $data = Room::queryTable($status);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-primary mr-2" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="fa fa-trash-alt"></i></a>';

                return $edit . $delete;
            })
            ->editColumn('status', function($p) {
                if ($p->status == 1) {
                    $status = '<span class="badge badge-success py-1 px-3 fs-12">Aktif</span>';
                } else {
                    $status = '<span class="badge badge-danger py-1 px-3 fs-12">Tidak Aktif</span>';
                }

                return $status;
                
            })
            ->rawColumns(['id', 'action', 'status'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:rooms,nama',
            'status' => 'required'
        ]);

        $input = $request->all();
        Room::create($input);

        return response()->json(['message' => "Berhasil menyiman data " . $this->title]);
    }

    public function edit($id)
    {
        $data = Room::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:rooms,nama,' . $id,
            'status' => 'required'
        ]);

        $input = $request->all();

        $data = Room::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data " . $this->title]);
    }

    public function destroy($id)
    {
        Room::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data " . $this->title]);
    }
}
