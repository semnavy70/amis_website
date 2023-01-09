<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subscriber extends Model
{
    public function type()
    {
        return $this->belongsTo('App\SubscriberType', 'sub_type');
    }
}
