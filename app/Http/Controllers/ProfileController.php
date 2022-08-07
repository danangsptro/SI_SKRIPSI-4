<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\User;

class ProfileController extends Controller
{
    protected $title = 'Profile';
    protected $pages = 'pages.profile.';
    protected $desc  = 'Menu ini berisikan data akun';

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;

        $user_id = Auth::user()->id;
        $data = User::find($user_id);

        return view($this->pages . 'index', compact(
            'title',
            'desc',
            'data'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'no_telp' => 'required',
            'departemen' => 'required'
        ]);

        $input = $request->all();
        $input = $request->except(['role_id']);

        $data = User::find($id);
        $data->update($input);

        return redirect()
            ->route('profile.index')
            ->withSuccess("Selamat! Data Profile berhasil diperbaharui.");
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        $data = User::find($id);
        $data->update([
            'password' => \md5($request->password)
        ]);

        return redirect()
            ->route('profile.index')
            ->withSuccess('Selamat! Password berhasil diperbaharui.');
    }
}
