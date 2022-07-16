<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('pages.management.index', compact('data'));
    }

    public function create()
    {
        return view('pages.management.create');
    }

    public function store (Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'position' => 'required|min:3',
            'company' => 'required|min:3',
            'status' => 'required|min:3',
            'contact' => 'required|min:3',

        ]);

        $data = new user();
        $data->name = $validate['name'];
        $data->email = $validate['email'];
        $data->username = $validate['username'];
        $data->position = $validate['position'];
        $data->company = $validate['company'];
        $data->status = $validate['status'];
        $data->contact = $validate['contact'];
        $data->password = Hash::make('qwerty');

        $data->save();

        toastr()->success(`Data, $data->name, has been saved successfully!`);
        return redirect('/management');

    }
}
