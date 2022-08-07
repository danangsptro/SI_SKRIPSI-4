<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(VisitPeople::class, 'visit_id', 'id');
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }

    public static function queryTable($role_id, $email, $status, $tgl_awal, $tgl_akhir)
    {
        $data = Visit::select('id', 'purpose_id', 'nama_pengunjung', 'perusahaan', 'jabatan', 'email', 'no_telp', 'ktp', 'tanggal', 'waktu', 'status', 'created_at')
            ->when($role_id == 3, function ($q) use ($email) {
                return $q->where('email', $email);
            })
            ->when($status != 99, function ($q) use ($status) {
                return $q->where('status', $status);
            });

        if ($tgl_awal != null ||  $tgl_akhir != null) {
            if ($tgl_awal != null && $tgl_akhir == null) {
                $data->whereDate('tanggal', $tgl_awal);
            } else {
                $data->whereBetween('tanggal', [$tgl_awal, $tgl_akhir]);
            }
        }

        return $data->get();
    }
}
