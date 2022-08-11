<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Visit;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role_id = Auth::user()->role_id;
        $email   = Auth::user()->email;

        //* Get total status
        $pending   = Visit::where('status', 0)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();
        $disetujui = Visit::where('status', 1)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();
        $ditolak   = Visit::where('status', 2)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();

        //* Total User
        $user = User::count();

        return view('home', compact(
            'pending',
            'disetujui',
            'ditolak',
            'user'
        ));
    }

    public function getNotifVisit()
    {
        $data = Visit::where('status', 0)->count();

        return $data;
    }
}
