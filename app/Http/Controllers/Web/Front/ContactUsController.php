<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index(){
        return Inertia::render('ContactUs');
    }
}
