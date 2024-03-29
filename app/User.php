<?php

namespace App;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = ['id', 'role_id', 'password', 'nama', 'email', 'perusahaan', 'departemen', 'jabatan', 'no_telp', 'ktp'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public static function queryTable($role_id)
    {
        $data = User::select('id', 'role_id', 'nama', 'email', 'perusahaan', 'departemen', 'jabatan', 'no_telp', 'ktp')
            ->when($role_id != 0, function ($q) use ($role_id) {
                return $q->where('role_id', $role_id);
            })->get();

        return $data;
    }
}
