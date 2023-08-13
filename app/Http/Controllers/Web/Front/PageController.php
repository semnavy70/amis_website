<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(){
        return Inertia::render('Page/Detail');
    }
}
