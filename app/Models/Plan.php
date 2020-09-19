<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

//

//    public function getAmountInDollarsAttribute()
//    {
//        return number_format($this->amount_in_dollars, 2);
//    }

//    public function getAmountInLocalCurrencyAttribute()
//    {
//        return number_format($this->amount_in_local_currency, 2);
//    }
}
