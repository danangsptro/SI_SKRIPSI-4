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

        //* Get total role
        $admin = User::where('role_id', '1')->count();
        $manager = User::where('role_id', '2')->count();
        $staff = User::where('role_id', '3')->count();
        $security = User::where('role_id', '4')->count();

        return view($this->pages . 'index', compact(
            'title',
            'desc',
            'roles',
            'admin',
            'manager',
            'staff',
            'security'
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
            ->editColumn('ktp', function ($p) {
                return '<a href="' . asset('file/ktp/' . $p->ktp) . '" target="blank" class="text-info" title="Lihat File"><i class="fa fa-file"></i></a>';
            })
            ->rawColumns(['id', 'action', 'ktp'])
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
        //* Validation
        $request->validate([
            'role_id' => 'required',
            'nama' => 'required|max:50',
            'email' => 'required|max:100',
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'no_telp' => 'required',
            'departemen' => 'required'
        ]);

        $input = $request->all();
        $input = $request->except(['ktp']);
        $password = Hash::make('123456789');

        $fileKTP  = $request->file('ktp');
        $fileNameKTP = time() . "." . $fileKTP->getClientOriginalName();  //TODO: Save KTP to storage
        $fileKTP->move("file/ktp/", $fileNameKTP);

        User::create($input + ['password' => $password, 'ktp' => $fileNameKTP]);

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
        $input = $request->except(['ktp']);
        $data  = User::find($id);

        $ktp = $request->ktp;
        if ($ktp) {
            $fileKTP  = $request->file('ktp');
            $fileNameKTP = time() . "." . $fileKTP->getClientOriginalName();  //TODO: Save KTP to storage
            $fileKTP->move("file/ktp/", $fileNameKTP);
        } else {
            $fileNameKTP = $data->ktp;
        }

        $data->update($input + ['ktp' => $fileNameKTP]);

        return response()->json(['message' => "Berhasil memperbaharui data " . $this->title]);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data " . $this->title]);
    }
}
