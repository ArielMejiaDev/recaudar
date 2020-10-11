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

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / 100;
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function getAmountToDepositAttribute()
    {
        return $this->attributes['amount_to_deposit'] / 100;
    }

    public function setAmountToDepositAttribute($value)
    {
        $this->attributes['amount_to_deposit'] = $value * 100;
    }

    public function getIncomeAttribute()
    {
        return $this->attributes['income'] / 100;
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = $value * 100;
    }

    public function getReadableCreatedAtAttribute() {
        return $this->created_at->format('d/m/Y');
    }
}
