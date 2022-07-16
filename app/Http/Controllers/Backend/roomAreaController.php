<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\roomArea;
use Illuminate\Http\Request;

class roomAreaController extends Controller
{
    public function index()
    {
        $data = roomArea::all();
        return view('pages.room-area.index', compact('data'));
    }

    public function create()
    {
        return view('pages.room-area.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|min:3',
        ]);

        $data = new roomArea();
        $data->name = $validate['name'];
        $data->status = $validate['status'];
        $data->save();

        toastr()->success(`Data, $data->name, has been saved successfully!`);
        return redirect('/area');
    }

    public function edit($id)
    {
        $data = roomArea::find($id);
        return view('pages.room-area.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|min:3',
        ]);

        $id = $request->id;
        $data = roomArea::find($id);
        $data->name = $validate['name'];
        $data->status = $validate['status'];
        $data->save();

        toastr()->success(`Data, $data->name, has been saved successfully!`);
        return redirect('/area');
    }

    public function delete($id)
    {
        $data = roomArea::find($id);
        $data->delete();

        toastr()->success(`Data, $data->name, has been delete successfully!`);
        return redirect('/area');
    }
}
