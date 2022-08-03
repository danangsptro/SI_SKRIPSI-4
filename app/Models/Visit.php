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

    public static function queryTable()
    {
        $data = Visit::all();

        return $data;
    }
}
