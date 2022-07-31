<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Purpose;

class PurposeController extends Controller
{
    protected $title = 'Purpose';
    protected $pages = 'pages.purpose.';
    protected $desc  = 'Menu ini berisikan data Purpose';

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;

        //* DataTable
        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view($this->pages . 'index', compact(
            'title',
            'desc'
        ));
    }

    public function dataTable()
    {
        $data = Purpose::queryTable();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-primary mr-2" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="fa fa-trash-alt"></i></a>';

                return $edit . $delete;
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required|unique:purposes,tujuan',
        ]);

        $input = $request->all();
        Purpose::create($input);

        return response()->json(['message' => "Berhasil menyiman data " . $this->title]);
    }

    public function edit($id)
    {
        $data = Purpose::find($id);

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tujuan' => 'required|unique:purposes,tujuan,' . $id,
        ]);

        $input = $request->all();

        $data = Purpose::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data " . $this->title]);
    }

    public function destroy($id)
    {
        Purpose::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data " . $this->title]);
    }
}
