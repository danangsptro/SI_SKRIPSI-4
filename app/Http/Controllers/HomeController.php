<?php

namespace App\Http\Controllers;

// Models
use App\Models\Visit;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function getNotifVisit()
    {
        $data = Visit::where('status', 0)->count();

        return $data;
    }
}
