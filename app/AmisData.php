<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
class AmisData extends Model
{
    protected $table = "amisdata";


    protected $primaryKey = 'dataid';

    public $timestamps = false;
    //

    public function market()
    {
        return $this->belongsTo('App\AmisMarket', 'marketcode','marketcode');
    }
    public function commodity()
    {
        return $this->hasMany('App\AmisCommodityLocale', 'commoditycode','commoditycode');
    }


}
