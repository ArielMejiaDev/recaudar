<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function availablePlans()
    {
        return $this->plans()->where('title', '!=', 'variable amount plan')->get();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
