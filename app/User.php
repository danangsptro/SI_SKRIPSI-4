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
    protected $fillable = ['id', 'role_id', 'nama', 'email', 'username', 'perusahaan', 'departemen', 'jabatan', 'no_telp'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public static function queryTable()
    {
        $data = User::all();

        return $data;
    }
}
