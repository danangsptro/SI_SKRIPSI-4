<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $title = 'Report';
    protected $pages = 'pages.report.';
    protected $desc  = 'Menu ini berisikan data Report';

    public function index(Request $request)
    {
        $title = $this->title;
        $desc  = $this->desc;

        $role_id = Auth::user()->role_id;
        $email   = Auth::user()->email;

        //* DataTable
        $status    = $request->status_filter;
        $tgl_awal  = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        if ($request->ajax()) {
            return $this->dataTable($role_id, $email, $status, $tgl_awal, $tgl_akhir);
        }

        //* Get total status
        $pending   = Visit::where('status', 0)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();
        $disetujui = Visit::where('status', 1)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();
        $ditolak   = Visit::where('status', 2)->when($role_id == 3, function ($q) use ($email) { return $q->where('email', $email); })->count();

        return view($this->pages . 'index', compact(
            'title',
            'desc',
            'role_id',
            'disetujui',
            'ditolak',
            'pending'
        ));
    }

    public function dataTable($role_id, $email, $status, $tgl_awal, $tgl_akhir)
    {
        $data = Visit::queryTable($role_id, $email, $status, $tgl_awal, $tgl_akhir);

        return DataTables::of($data)
            ->editColumn('nama_pengunjung', function ($p) {
                return "<a href='" . route('visit.show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->nama_pengunjung . "</a>";
            })
            ->addColumn('tgl_request', function ($p) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at)->format('d F Y / H:i:s');
            })
            ->addColumn('tgl_visit', function ($p) {
                $date = Carbon::createFromFormat('Y-m-d', $p->tanggal)->format('d F Y');
                $hour = Carbon::createFromFormat('H:i:s', $p->waktu)->format('H:i:s');

                return $date . ' / ' . $hour;
            })
            ->addColumn('jumlah', function ($p) {
                $totalPeople = $p->people->count();

                return $totalPeople + 1 . ' Orang';
            })
            ->editColumn('status', function ($p) {
                $belum = '<span class="badge badge-warning py-1 px-3 fs-12">Pending</span>';
                $sudah = '<span class="badge badge-success py-1 px-3 fs-12">Sudah</span>';
                $ditolak = '<span class="badge badge-danger py-1 px-3 fs-12">Ditolak</span>';

                if ($p->status == 0) {
                    return $belum;
                } elseif ($p->status == 1) {
                    return $sudah;
                } elseif ($p->status == 2) {
                    return $ditolak;
                }
            })
            ->rawColumns(['id', 'action', 'nama_pengunjung', 'status'])
            ->addIndexColumn()
            ->toJson();
    }

    public function cetakPDF(Request $request)
    {
        //* Get Params
        $status    = $request->status_filter;
        $tgl_awal  = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $datas = Visit::queryCetakPDF($status, $tgl_awal, $tgl_akhir);

        //TODO: Print to PDF
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('portrait');
        $pdf->loadView('pages.report.report-pdf', compact(
            'datas',
            'tgl_awal',
            'tgl_akhir'
        ));

        return $pdf->stream("Data Laporan Visit.pdf");
    }
}
