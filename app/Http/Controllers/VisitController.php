<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use App\Models\Room;
use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Visit;

class VisitController extends Controller
{
    protected $title = 'Visit';
    protected $pages = 'pages.visit.';
    protected $desc  = 'Menu ini berisikan data Visit';

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
        $data = Visit::queryTable();

        return DataTables::of($data)
            ->rawColumns(['id'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create()
    {
        $title = $this->title;
        $desc  = 'Menu ini berisikan tambah Visit';

        $rooms = Room::select('id', 'nama', 'status')->where('status', 1)->get();
        $purposes = Purpose::select('id', 'tujuan')->get();

        return view($this->pages . 'create', compact(
            'title',
            'desc',
            'rooms',
            'purposes'
        ));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
