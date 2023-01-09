<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class ArticleController extends Controller
{
    public function Index($id)
    {
        //dd($slug);
        $post = Post::where('id',$id)->FirstOrFail();
        $post->view_count=$post->view_count+1;
        $post->save();

        // $pop=Post::where('id',"<>",$id)->where('category_id',"<>",11)->orderBy('view_count','DESC')->take(3)->get();

        // dd($slug);
         $related = null;

         if($post->category_id == 18)
         {
             $related = Post::where('id',"<>",$id)->where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id','asc')->get();
         }
         elseif($post->category_id == 19)
         {
             $related = Post::where('id',"<>",$id)->where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id','asc')->get();
         }
         else
         {
             $related = Post::where('id',"<>",$id)->where('status', 'published')->orderBy('id','desc')->take(5)->get();
         }

        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $cat=Category::find($post->category_id);
        $active="topic/".$cat->slug;

        $data = array(
            "category" => $cat,
            "post" => $post,
            "meta" => getMetaKey($post),
            // "pop" => $pop,
            "related" => $related,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
            "active" => $active
        );
        
        return View('article.index',$data);
    }
}
