<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = ['page', 'blog_no', 'name', 'blog_no', 'image', 'image_mobile', 'image_tablet', 'link'];
    public $timestamps = true;
    /**
     * @var mixed
     */
    /**
     * @var mixed
     */
    use HasFactory;
}
