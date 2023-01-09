<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use TCG\Voyager\Facades\Voyager;
class Post extends Model
{
    use Translatable;
    protected $translatable = ['title','excerpt', 'body','image'];
    //

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
