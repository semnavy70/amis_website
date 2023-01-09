<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use TCG\Voyager\Facades\Voyager;
class Link extends Model
{
    use Translatable;
    protected $translatable = ['title'];




}
