<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\User;
use App\Models\Room;
use App\Models\Visit;
use App\Models\Purpose;
use App\Models\VisitRoom;
use App\Models\VisitPeople;

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
            ->addColumn('action', function ($p) {
                $delete = '<a href="#" onclick="remove(' . $p->id . ')" class="text-danger" title="Delete Data"><i class="fa fa-trash-alt"></i></a>';

                return $p->status == 0 ? $delete : '-';
            })
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
                $belum = '<span class="badge badge-danger py-1 px-3 fs-12">Belum</span>';
                $sudah = '<span class="badge badge-success py-1 px-3 fs-12">Sudah</span>';

                return $p->status == 0 ? $belum : $sudah;
            })
            ->rawColumns(['id', 'action', 'nama_pengunjung', 'status'])
            ->addIndexColumn()
            ->toJson();
    }

    public function create()
    {
        $title = 'Form ' . $this->title;
        $desc  = 'Menu ini berisikan tambah Visit';

        $rooms = Room::select('id', 'nama', 'status')->where('status', 1)->get();
        $purposes = Purpose::select('id', 'tujuan')->get();

        //* Check Role
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role->id;

        $dataVisitStaff = [];
        if ($role_id == 3) {
            $dataVisitStaff = User::find($user_id);
        }

        return view($this->pages . 'create', compact(
            'title',
            'desc',
            'rooms',
            'purposes',
            'dataVisitStaff'
        ));
    }

    public function store(Request $request)
    {
        //* Validation
        $request->validate([
            'nama_pengunjung' => 'required',
            'email' => 'required',
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'no_telp' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'
        ]);

        //* Get Params
        $nama_pengunjung = $request->nama_pengunjung;
        $email = $request->email;
        $perusahaan = $request->perusahaan;
        $jabatan = $request->jabatan;
        $no_telp = $request->no_telp;
        $surat_tugas = $request->surat_tugas;
        $surat_izin = $request->surat_izin;
        $room_id = $request->room_id;
        $purpose_id = $request->purpose_id;
        $ket = $request->ket;
        $tanggal = $request->tanggal;
        $waktu = $request->waktu;
        $nama_visitor = $request->nama_visitor;
        $jabatan_visitor = $request->jabatan_visitor;
        $ktp_visitor = $request->ktp_visitor;
        $perusahaan_visitor = $request->perusahaan_visitor;
        $is_staff = $request->is_staff;

        /* Tahapan
         * 1. visits
         * 2. visit_rooms
         * 3. visit_peoples
         */

        DB::beginTransaction(); //* DB Transaction Begin

        try {
            //* Tahap 1
            if ($is_staff) {
                $fileNameKTP = Auth::user()->ktp;
            } else { 
                $fileKTP  = $request->file('ktp');
                $fileNameKTP = time() . "." . $fileKTP->getClientOriginalName();  //TODO: Save KTP to storage
                $fileKTP->move("file/ktp/", $fileNameKTP);
            }

            if ($surat_tugas) {
                $fileSuratTugas     = $request->file('surat_tugas');
                $fileNameSuratTugas = time() . "." . $fileSuratTugas->getClientOriginalName();  //TODO: Save Surat Tugas to storage
                $fileSuratTugas->move("file/surat_tugas/", $fileNameSuratTugas);
            }

            if ($surat_izin) {
                $fileSuratIzin     = $request->file('surat_izin');
                $fileNameSuratIzin = time() . "." . $fileSuratIzin->getClientOriginalName();  //TODO: Save Surat Izin to storage
                $fileSuratIzin->move("file/surat_izin/", $fileNameSuratIzin);
            }

            $dataVisit = [
                'purpose_id' => $purpose_id,
                'nama_pengunjung' => $nama_pengunjung,
                'perusahaan' => $perusahaan,
                'jabatan' => $jabatan,
                'no_telp' => $no_telp,
                'ktp' => $fileNameKTP,
                'email' => $email,
                'surat_izin' => $surat_izin ? $fileNameSuratIzin : null,
                'surat_tugas' => $surat_tugas ? $fileNameSuratTugas : null,
                'tanggal' => $tanggal,
                'waktu' => $waktu,
                'ket' => $ket,
                'status' => 0
            ];
            $visit = Visit::create($dataVisit);

            //* Tahap 2
            foreach ($room_id as $i) {
                $dataVisitRoom = [
                    'visit_id' => $visit->id,
                    'room_id' => $i
                ];

                VisitRoom::create($dataVisitRoom);
            }

            //* Tahap 3
            $getTotalArray = count($request->nama_visitor);

            for ($k = 0; $k < $getTotalArray; $k++) {
                if (isset($ktp_visitor[$k])) {
                    $fileKTPVisitor  = isset($request->file('ktp_visitor')[$k]);
                    $fileNameKTPVisitor = time() . "." . $fileKTPVisitor->getClientOriginalName();  //TODO: Save KTP to storage
                    $fileKTPVisitor->move("file/ktp/", $fileNameKTPVisitor);
                }

                $dataVisitPeople = [
                    'visit_id' => $visit->id,
                    'nama' => $nama_visitor[$k],
                    'jabatan' => $jabatan_visitor[$k],
                    'perusahaan' => $perusahaan_visitor[$k],
                    'ktp' => isset($ktp_visitor[$k]) ? $fileNameKTPVisitor : null
                ];

                VisitPeople::create($dataVisitPeople);
            }
        } catch (\Throwable $th) {
            DB::rollback(); //* DB Transaction Failed
            return response()->json(['message' => "Terjadi kesalahan, silahkan hubungi administrator"], 500);
        }

        DB::commit(); //* DB Transaction Success

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function destroy($id)
    {
        Visit::destroy($id);

        return response()->json(['message' => "Berhasil menghapus data " . $this->title]);
    }
}
