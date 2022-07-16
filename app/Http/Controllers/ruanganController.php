<?php

namespace App\Http\Controllers;

use App\Http\Models\ruangan;
use Illuminate\Http\Request;

class ruanganController extends Controller
{
    public function index()
    {
        $data = ruangan::all();
        return view('pages.ruangan.index', compact('data'));
    }

    public function create()
    {
        return view('pages.ruangan.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_ruangan' => 'required|min:3',
            'jenis_ruangan' => 'required|min:3',
        ]);

        $data = ruangan::create($request->all());
        $data->nama_ruangan = $validate['nama_ruangan'];
        $data->jenis_ruangan = $validate['jenis_ruangan'];
        toastr()->success('Data has been saved successfully!');

        return redirect('/ruangan');


        // $data->nama_ruangan = $validate['nama_ruangan'];
        // $data->jenis_ruangan = $validate['jenis_ruangan'];

    }
}
