<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use \TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function Index()
    {
        return View('production.index');
    }
    public function submitproduction(Request $request){
        dd($request->all());
    }

}
