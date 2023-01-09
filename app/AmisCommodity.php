<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
class AmisCommodity extends Model
{
    protected $table = "amiscommodity";

    protected $primaryKey = 'commoditycode';
    //

    public function locale()
    {
        return $this->hasMany('App\AmisCommodityLocale', 'commoditycode','commoditycode');
    }

}
