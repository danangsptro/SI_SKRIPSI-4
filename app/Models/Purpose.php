<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $table = 'purposes';
    protected $fillable = ['id', 'tujuan'];

    public static function queryTable()
    {
        $data = Purpose::select('id', 'tujuan')->get();

        return $data;
    }
}
