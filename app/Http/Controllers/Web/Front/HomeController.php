<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

        return Inertia::render('Home/Home');
    }
}
