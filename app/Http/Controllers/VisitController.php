<?php

namespace App\Http\Controllers;

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

        $roles = Role::select('id', 'nama')->get();

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
}
