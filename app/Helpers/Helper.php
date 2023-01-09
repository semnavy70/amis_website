<?php

/**
* Author: KET SAKDA
* KRAVANH Technology
* Load helper.php in composer.json 
* run command php artisan dump-autoload
* user: ketsakda@kravanh.com
* pass: imsi00
*/


function links(){
    $links = App\Link::orderBy("created_at","desc")->take(6)->get();
    $links->load('translations');
    $str = "<ul>";
    foreach ($links as $item){
        $item = $item->translate(App::getLocale());
        $str = $str."<li><a href='".$item->link."'>".$item->title."</a></li>";
    }
    $str = $str."<li><a href='".route('links')."'>".Lang::get('translator.readmore')."</a></li>";
    $str = $str."</ul>";
    return $str;
}
function app_url($uri)
{
    if ((empty($uri) == true) || ($uri == '#')) return "#";
 
    $re="/https:/";
    $re_one="/http:/";

    preg_match_all($re, $uri, $matches, PREG_SET_ORDER, 0);
    if((count($matches)==1)) return $uri;
    preg_match_all($re_one, $uri, $matches, PREG_SET_ORDER, 0);
    if((count($matches)==1)) return $uri;

    $lang = app()->getLocale() == 'kh' ? '' : app()->getLocale().'/' ;
    return url($lang.$uri);
}

function url_switch_lang($lang = 'kh')
{
    $uri_path = parse_url(url()->current(), PHP_URL_PATH);
    $current_lang = Request::segment(1);
    
    if ($lang == App::getLocale())
    {
        return "javascript:void(0)";
    }
    else
    {
        $url_switch = $uri_path;
        $lang_exist = (bool) in_array($current_lang, config('app.available_locales'));
        //default or not
        //dd($lang_exist.'-'.$lang);
        if ($lang_exist == true && $lang == 'kh')
        {
            $delimiter = strlen($uri_path) > 3 ? '/' : null;
            
            $url_switch = str_replace('/'.$current_lang.$delimiter,'/',$uri_path);
            //dd($url_switch);    
        }
        else if($lang_exist == true && $lang != 'kh') 
        {
            $url_switch = str_replace('/'.$current_lang.'/','/'.$lang.'/',$uri_path);
        }
        else if ($lang_exist == false)
        {
            $url_switch = '/'.$lang.$uri_path;
        }
        return $url_switch;
    }
    
}   
function getLink($post)
{
    $link = app_url('article/'.$post->id);
    if ($post->body == null && $post->pdf != null)
    {
        $link = app_url('storage/'.$post->pdf);
    }

    return $link;
}

function iconActive ($value)
{
    return $value == 0 ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>' ;
}

function getCatbySlug($slug,$id = false)
{
    $cat = TCG\Voyager\Models\Category::where('slug',$slug)->firstOrFail();
    if ($id) $cat = $cat->id;
    return $cat;
}

function getMetaKey($data,$type = 'article')
{
     $url = url($type,$data->slug);
     $obj = new stdClass();
     $obj->title = $data->title;
     $obj->image = url('storage',$data->image);
     $obj->url = $url;
     $obj->excerpt = $data->excerpt;
     return $obj;
}
function getFileLink($str)
{
    if($str!=null)
    {
        $str=explode(",", $str);
        $str=explode(":", $str[0]);
        $str=substr($str[1],1,-1);
        return $str;
    }
}
function daykhmer($date)
{
    if(App::getLocale()=="kh")
    {
        $r="";
        $full_day=Carbon\Carbon::parse($date)->format('l');
        $day=Carbon\Carbon::parse($date)->format('d');
        $mon=monthkhmer(Carbon\Carbon::parse($date)->format('m'));
        $year=Carbon\Carbon::parse($date)->format('Y');
        $r="ថ្ងៃ ".fulldaykhmer($full_day)." ទី ".makenumerkhmer($day)." ខែ ".$mon." ឆ្នាំ ".makenumerkhmer($year);
        return $r;
    }
    else
    {
        return Carbon\Carbon::parse($date)->format('l jS M Y');
    }
}
function daykhmerLibrary($date)
{
    if(App::getLocale()=="kh")
    {
        $r="";
        $full_day=Carbon\Carbon::parse($date)->format('l');
        $day=Carbon\Carbon::parse($date)->format('d');
        $mon=monthkhmer(Carbon\Carbon::parse($date)->format('m'));
        $year=Carbon\Carbon::parse($date)->format('Y');
        $r= makenumerkhmer($day)." ".$mon." ".makenumerkhmer($year);
        return $r;
    }
    else
    {
        return Carbon\Carbon::parse($date)->format('jS M Y');
    }
}
function makenumerkhmer($number)
{
    $kh="";
    $len=strlen($number);
    if($len>=0)
    {
        $arr = str_split($number);
        for($i=0;$i<$len;$i++)
        {
            switch($arr[$i])
            {
                case "1":$kh.="១";
                break;
                case "2":$kh.="២";
                break;
                case "3":$kh.="៣";
                break;
                case "4":$kh.="៤";
                break;
                case "5":$kh.="៥";
                break;
                case "6":$kh.="៦";
                break;
                case "7":$kh.="៧";
                break;
                case "8":$kh.="៨";
                break;
                case "9":$kh.="៩";
                break;
                case "0":$kh.="០";
                break;

            }
        }
        
    }
    return $kh;
    
}
function monthkhmer($i)
{
    $mon = array("មករា", "កុម្ភៈ", "មិនា","មេសា","ឧសភា","មិថុនា","កក្កដា","សីហា","កញ្ញា","តុលា","វិច្ឆិកា","ធ្នូ");
    return $mon[$i-1];
}
function fulldaykhmer($day){
    switch($day)
    {
        case "Monday":$day="ចន្ទ";
        break;
        case "Tuesday":$day="អង្គារ";
        break;
        case "Wednesday":$day="ពុធ";
        break;
        case "Thursday":$day="ព្រហស្បតី៏";
        break;
        case "Friday":$day="សុក្រ";
        break;
        case "Saturday":$day="សៅរ៏";
        break;
        case "Sunday":$day="អាទិត្យ";
        break;
    }
    return $day;
}
function shorttitle($ft)
{
    //dd(strlen($ft));
    $len=strlen($ft);
    //dd($len);
    if(App::getLocale()=="kh")
    {
        if($len>390)
            $ft=mb_substr($ft,0,110, "utf-8")."...";
    }
    else
    {
        if($len>110)
            $ft=substr($ft,0,96)."..."; 
        //dd($ft);
    }
    return $ft;
}
function shorttitleBox($ft,$l=60)
{
    $len=strlen($ft);
    //dd($len);
    if(App::getLocale()=="kh")
    {
        if($len>50)
            $ft=mb_substr($ft,0,$l, "utf-8")."...";
    }
    else
    {
        if($len>35)
            $ft=substr($ft,0,35)."..."; 
        //dd($ft);
    }
    return $ft;
}


function gcpUrl($url){
    return "https://storage.googleapis.com/amis_website/".$url;
}
?>

