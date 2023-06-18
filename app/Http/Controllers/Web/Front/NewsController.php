<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(){
        return Inertia::render('News/Index');
    }
    public function detail(){
        return Inertia::render('News/Detail');
    }
}
