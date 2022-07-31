<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Models
use App\User;
use App\Models\Role;

class UserController extends Controller
{
    protected $title = 'User';
    protected $pages = 'pages.user.';
    protected $desc  = 'Menu ini berisikan data User';

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;

        //* DataTable
        $role_id = $request->role_id_filter;
        if ($request->ajax()) {
            return $this->dataTable($role_id);
        }

        $roles = Role::select('id', 'nama')->get();

        return view($this->pages . 'index', compact(
            'title',
            'desc',
            'roles'
        ));
    }

    public function dataTable($role_id)
    {
        $data = User::queryTable($role_id);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $edit = '<a href="#" onclick="edit(' . $p->id . ')" class="text-primary mr-2" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="fa fa-trash-alt"></i></a>';

                return $edit . $delete;
            })
            ->editColumn('role_id', function ($p) {
                return $p->role->nama;
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function edit($id)
    {
        $data = User::find($id);

        return $data;
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'nama' => 'required|max:50',
            'email' => 'required|max:100|unique:users,email',
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'no_telp' => 'required',
            'departemen' => 'required'
        ]);

        $password = Hash::make('123456789');

        $input = $request->all();
        User::create($input + ['password' => $password]);

        return response()->json(['message' => "Berhasil menyiman data " . $this->title]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required',
            'nama' => 'required|max:50',
            'email' => 'required|max:100|unique:users,email,' . $id,
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'no_telp' => 'required',
            'departemen' => 'required'
        ]);

        $input = $request->all();

        $data = User::find($id);
        $data->update($input);

        return response()->json(['message' => "Berhasil memperbaharui data " . $this->title]);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data " . $this->title]);
    }
}
