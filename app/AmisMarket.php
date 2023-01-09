<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
class AmisMarket extends Model
{
    protected $table = "amismarket";
    public $timestamps = false;
    protected $primaryKey = 'marketcode';
    //

    public function locale()
    {
        return $this->hasMany('App\AmisMarketLocale', 'marketcode','marketcode');
    }
    public function region(){
        return $this->hasMany('App\AmisRegionLocale', 'regioncode','regioncode');
    }

}
