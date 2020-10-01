<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    protected $appends = [
        'readable_created_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getReadableCreatedAtAttribute() {
        return $this->created_at->format('d/m/Y');
    }
}
