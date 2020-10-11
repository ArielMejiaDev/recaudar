<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getIncomeChargeAttribute()
    {
        return $this->attributes['income_charge'] / 100;
    }

    public function setIncomeChargeAttribute($value)
    {
        $this->attributes['income_charge'] = $value * 100;
    }

    public function getGatewayChargeAttribute()
    {
        return $this->attributes['gateway_charge'] / 100;
    }

    public function setGatewayChargeAttribute($value)
    {
        $this->attributes['gateway_charge'] = $value * 100;
    }
}
