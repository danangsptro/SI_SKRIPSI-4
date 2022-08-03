<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitPeople extends Model
{
    protected $table = 'visit_peoples';
    protected $guarded = [];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
