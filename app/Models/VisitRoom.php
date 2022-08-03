<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitRoom extends Model
{
    protected $table = 'visit_rooms';
    protected $guarded = [];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
