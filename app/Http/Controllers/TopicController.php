<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Link;
use App\Category;
use \TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;


class TopicController extends Controller
{
    public function Index($cat_slug)
    {
        $cat = getCatbySlug($cat_slug);
        $list_news = Post::where('category_id',$cat->id)->orWhere('category_id', getCatbySlug('monthly-highlight', true))->orWhere('category_id', getCatbySlug('video', true))->orWhere('category_id', getCatbySlug('audio', true))->where('status','PUBLISHED')->orderBy('created_at','desc')->paginate(6);
        
        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $pop=Post::where('category_id',"<>",11)->orderBy('view_count','DESC')->take(3)->get();
        $new=Post::where('category_id',"<>",11)->orderBy('id','DESC')->take(3)->get();

        $data = array(
            "list_news" => $list_news,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
            "title" => $cat->name,
            "category" => $cat,
            "pop" => $pop,
            "new"=>$new,
        );

        return View('topic.index',$data);
    }
    public function links()
    {

        $links = Link::orderBy('created_at','desc')->paginate(20);

        $related = Post::where('id',"<>",80)->where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id','asc')->get();

        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $pop=Post::where('category_id',"<>",11)->orderBy('view_count','DESC')->take(3)->get();
        $new=Post::where('category_id',"<>",11)->orderBy('id','DESC')->take(3)->get();

        $data = array(
            "links" => $links,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
            "pop" => $pop,
            "new"=>$new,
            "related" => $related,
            "active" => "links"
        );

        //return $data;
        return View('topic.links',$data);
    }

}
