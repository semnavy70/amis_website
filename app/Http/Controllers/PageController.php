<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Post;
use App\Category;
use App\Subscriber;
use App\Library;
use App\DocumentType;
use App\Contact;
use Mail;
use Lang;
class PageController extends Controller
{
    public function Index($slug)
    {
        $page = Page::where('slug',$slug)->where('status','ACTIVE')->firstOrFail();
        
        $relate = Page::where('group_id', $page->group_id)->where('id', '<>', $page->id)->where('status', 'ACTIVE')->get();
        if($slug=="sms-how-it-works"){
            $c = new Page();
            $c->id =0 ;
            $c->author_id =0 ;
            if(Lang::locale()=="kh"){
                $c->title = "ផលិតកម្ម​​" ;
            }else{
                $c->title = "Production" ;
            }
            $c->slug = "../production" ;
            $c->excerpt = "" ;
            $c->body = "";
            $c->image = "";
            $c->group_id = 1;
        
            $relate[] = $c;
            //dd(Lang::locale());
        }
        

        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        
        $pop=Post::where('slug',"<>",$slug)->where('category_id',"<>",11)->orderBy('view_count','DESC')->take(3)->get();
        $new=Post::where('slug',"<>",$slug)->where('category_id',"<>",11)->orderBy('id','DESC')->take(3)->get();
       
        $page->load('translations');
       
        $data = array(
            "page" => $page,
            "relate" => $relate,
            "meta" => getMetaKey($page),
            "pop" => $pop,
            "new"=>$new,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
        );

        if($slug == "sms-subscribe")
        {
            return view('page.subscribe', $data);
        }

        if($slug == "sms-pricing-data")
        {
            return view('page.price_data', $data);
        }

        if($slug == "contact-us")
        {                        
            return view('page.contact', $data);
        }

        return View('page.index',$data);
    }

    public function storeSubscriber(Request $request)
    {
        $this->validate($request,[
            "name" => "required",
            "email" => "required|email",
            "phone" => "required"
        ]);

        $subscriber = new Subscriber();
        $subscriber->sub_type = $request->sub_type;
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->phone = $request->phone;
        $subscriber->address = $request->address;
        $subscriber->save();

        $data = array(
            'name' => $subscriber->name,
            'email' => $subscriber->email,
            'phone' => $subscriber->phone,
            'sub_type' => $subscriber->type->name,
            'address' => $subscriber->address
        );

        // dd($data);

        Mail::send('emails.index', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('agrimarketinfo@gmail.com');
            $message->subject('New Subscriber');
        });

        return redirect()->back()->with('status', 'Thanks for getting in touch with us. Please send us any questions you may have.');
    }

    public function storeContact(Request $request)
    {
        $this->validate($request,[
            "name" => "required",
            "email" => "required|email",
            "message" => "required"
        ]);

        $subscriber = new Contact();
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->message = $request->message;
        $subscriber->site_lang = $request->site_lang;
        $subscriber->save();

        $data = array(
            'name' => $subscriber->name,
            'email' => $subscriber->email,
            'message' => $subscriber->message,
            'site_lang' => $subscriber->site_lang,
        );

        // dd($data);

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('agrimarketinfo@gmail.com');
            $message->subject('You have got a new contact from amis.org.kh');
        });

        return redirect()->back()->with('status', 'Thanks for getting in touch with us. Please send us any questions you may have.');
    }

    public function document($slug)
    {
        // dd($slug);
        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $all_doc = DocumentType::all();
        $doc_type = DocumentType::where('slug', $slug)->first();
        // dd($doc_type);
        $document = Library::where('status', 1)->where('doc_type', $doc_type->id)->orderBy('id', 'desc')->take(12)->get();
        // dd($document);
        $data = array(
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
            'doc_type' => $doc_type,
            'document' => $document,
            'all_doc' => $all_doc
        );
        // dd($data);
        return view('page.library', $data);

    }

    public function coming()
    {
        return view('page.coming');
    }

}
