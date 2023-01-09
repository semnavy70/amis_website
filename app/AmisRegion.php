<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
class AmisRegion extends Model
{
    protected $table = "amisregion";
    public $timestamps = false;
    protected $primaryKey = 'regioncode';
    //regioncode

    public function region()
    {
        return $this->hasMany('App\AmisRegionLocale', 'regioncode');
    }

}
