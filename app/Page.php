<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use TCG\Voyager\Facades\Voyager;
class Page extends Model
{
    use Translatable;
    protected $translatable = ['title','body'];
}
