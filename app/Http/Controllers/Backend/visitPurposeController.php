<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\visitPurpose;
use Illuminate\Http\Request;

class visitPurposeController extends Controller
{
    public function index()
    {
        $data = visitPurpose::all();
        return view('pages.visit-purpose.index', compact('data'));
    }

    public function create()
    {
        return view('pages.visit-purpose.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|min:3'
        ]);

        $data = new visitPurpose();
        $data->name = $validate['name'];
        $data->status = $validate['status'];
        $data->save();
        toastr()->success(`Data, $data->name, has been saved successfully!`);
        return redirect('visit-purpose');
    }

    public function edit($id)
    {
        $data = visitPurpose::find($id);
        return view('pages.visit-purpose.edit', compact('data'));
    }

    public function update (Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|min:3',
        ]);

        $id = $request->id;
        $data = visitPurpose::find($id);
        $data->name = $validate['name'];
        $data->status = $validate['status'];
        $data->save();

        toastr()->success(`Data has been update successfully!`);
        return redirect('visit-purpose');
    }

    public function delete ($id)
    {
        $data = visitPurpose::find($id);
        $data->delete();

        toastr()->success(`Data has been delete successfully!`);
        return redirect()->back();
    }
}
