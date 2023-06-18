<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index(){
        return Inertia::render('Document');
    }
}
