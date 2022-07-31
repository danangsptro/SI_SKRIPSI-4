<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = ['id', 'nama', 'status'];

    public static function queryTable($status)
    {
        $data = Room::select('id', 'nama', 'status')
            ->when($status != 99, function ($q) use ($status) {
                return $q->where('status', $status);
            })->get();

        return $data;
    }
}
