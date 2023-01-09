<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
class AmisCategory extends Model
{
    protected $table = "amiscategory";
    public $timestamps = false;
    protected $primaryKey = 'categorycode';

    public function region()
    {
        return $this->hasMany('App\AmisCategoryLocale', 'categorycode');
    }

}
