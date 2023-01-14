<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\Post;
use Illuminate\Support\Facades\DB;
use Lang;
use Carbon\Carbon;

class OnlineMarketController extends Controller
{
    public function index()
    {
        $new = Post::where('category_id',13)->select('id','author_id','title','excerpt','body','image','created_at')->paginate(10);
        foreach ($new as $item)
        {
            $item->image = gcpUrl($item->image);
            $item->author_id = $item->authorId->name;
        }
        return $new;
    }
    public function detail($id)
    {
        $new = Post::findOrFail($id);
        $new->image = gcpUrl($new->image);
        $new->author_id = $new->authorId->name;
        return $new;
    }
    public function getlatestprice()
    {
        dd("hello");
        $code = $_GET['code'];
        $date = Carbon::parse($_GET['date']);
        $data = array(
            'code'=>$code,
            'date'=>$date,
        );
        return $data;

    }
}
