<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SlideShow;
use App\Post;
use App\Link;
use App\AmisData;
use App\AmisCommodity;
use App\AmisMarket;
use App\AmisMarketLocale;
use Illuminate\View\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function Index()
    {


        $list_slide = SlideShow::where('status', 1)->orderBy('id','desc')->take(3)->get();

        $links = Link::orderBy('created_at','desc')->take(4)->get();

        $monthly = Post::where('category_id', getCatbySlug('monthly-highlight', true))->where('status', 'published')->orderBy('created_at', 'desc')->first();
        $production = Post::where('category_id', getCatbySlug('production', true))->where('status', 'published')->orderBy('created_at', 'desc')->first();

        $news = Post::where('category_id', getCatbySlug('news-and-events', true))->orWhere('category_id', getCatbySlug('video', true))->orWhere('category_id', getCatbySlug('audio', true))->Where("id","!=",$monthly->id)->orderBy('created_at', 'desc')->take(3)->get();

        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $monthly->load('translations');
        $production->load('translations');
        $news->load('translations');
        $agri_office->load('translations');
        $agri_info->load('translations');
        $links->load('translations');
        $mon = $this->monthkhmer(Carbon::now()->format('m'));
        $monEN = Carbon::now()->format('F');
        // dd($monEN);

        $data = array(
            "list_slide" => $list_slide,
            "links" => $links,
            "monthly" => $monthly,
            "production"=>$production,
            "news" => $news,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
            'month' => $mon,
            'monthEN' => $monEN
        );
        return View('home.index',$data);
    }

    public function search(Request $request)
    {
        $agri_office = Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();

        $query = $request->input('search');

        if(\App::getLocale() == 'en')
        {
            $posts=Post::whereHas('translations', function ($q) use ($query) {
                $q->where('locale', 'en')
                    ->where('value','like','%'.$query.'%');
            })->orderBy('id','DESC')->paginate(6);
            $posts->appends(['search' => $query]);
        }
        else
        {
            $posts=Post::where('title','like','%'.$query.'%')->orwhere('excerpt','like','%'.$query.'%')->orwhere('body','like','%'.$query.'%')->orderBy('id','DESC')->paginate(6);
            $posts->appends(['search' => $query]);
        }

        $data=array(
            'post' => $posts,
            'query' => $query,
            "agri_office" => $agri_office,
            "agri_info" => $agri_info,
        );
        return view('home.search',$data);
    }
    
    public function getMonthly($dataseriescode,$cultureid){
        $startdate = Carbon::now()->subMonth();
        //$startdate = Carbon::now()->subMonths(2);
        $startdate->day =1;
        //$enddate = Carbon::now()->addMonth();
        $enddate = Carbon::now();
        //$enddate->day=1;

        //$this->listall = DB::table('amisdata')->where('date','>=',$startdate)->where('date','<=',$enddate)->where('dataseriescode',$dataseriescode)->where('commoditycode',12002 )->orderBy('date','DESC');
        //return $listall->get();
        $commodities = AmisCommodity::where("is_showed",1)->get();
        //return $commodities;
        $makets = AmisData::where('date','>=',$startdate)->where('date','<=',$enddate)->where('dataseriescode',$dataseriescode)->orderBy('marketcode','ASC')->orderBy('date','ASC')->select('marketcode')->groupBy('marketcode')->get();
        $arr = array_pluck($makets,'marketcode');
        //return $makets;

        $sample = Db::table('amisdata')->whereIn('marketcode',$arr)->where('date','>=',$startdate)->where('date','<=',$enddate)->where('dataseriescode',$dataseriescode)->where('datasourcecode','!=',"SMS")->get();
        //define("alldata",$sample);
        //dd($sample);
        session_start();
        $_SESSION['alldata'] = $sample;
        //return $sample;
        $list = array();


        foreach ($makets as $item){

            $list1 = array();
            $test = false;
            foreach ($commodities as $item1){
                $commodity = $this->find($item1->commoditycode,$item->marketcode);
                $list1[] = array(
                    'name'=>$item1->locale->where('cultureid',$cultureid)->first()->name,
                    'diff'=>$commodity['diff'],
                    'new'=>$commodity['new'],
                    'p'=>$commodity['p']
                );
                //print_r($commodity['diff']);
                if($commodity['diff']!=0){
                    $test = true;
                }
            }
            if($test){

                $list[] = array(
                    "market"=>AmisMarketLocale::where("marketcode",$item["marketcode"])->where("cultureid",$cultureid)->first(),
                    "region"=>$item->market->region->where("cultureid",$cultureid)->first(),
                    "commodity"=>$list1
                );
            }
           
        }
        return $list;
    }

    public function find($commoditycode,$marketcode){
        $c = 0;
        $c1 = 0;
        $value = 0;
        $value1 = 0;
        $date = Carbon::now();
        //$date = Carbon::now()->subMonth();
        $date->day =1;

        $list = $_SESSION["alldata"];

        //$tmp1 = array();
        //$tmp2 = array();
        foreach ($list as $item){
            //return $item;
            //dd($date->diffInHours(Carbon::parse($item->date),false)."-".$item->date."-".$date);
            if(($item->commoditycode==$commoditycode) && ($item->marketcode==$marketcode)){

                if($date->diffInHours(Carbon::parse($item->date),false)>0){
                    //$tmp1[] = $item;
                    if($item->value1>0){
                        $c++;
                        $value += floatval($item->value1);
                    }
                    if($item->value2>0){
                        $c++;
                        $value += floatval($item->value2);
                    }
                    if($item->value3>0){
                        $c++;
                        $value += floatval($item->value3);
                    }
                    if($item->value4>0){
                        $c++;
                        $value += floatval($item->value4);
                    }
                    if($item->value5>0){
                        $c++;
                        $value += floatval($item->value5);
                    }
                    if($item->value6>0){
                        $c++;
                        $value += floatval($item->value6);
                    }
                }else{
                    //$tmp2[] = $item;
                    if($item->value1>0){
                        $c1++;
                        $value1 += floatval($item->value1);
                    }
                    if($item->value2>0){
                        $c1++;
                        $value1 += floatval($item->value2);
                    }
                    if($item->value3>0){
                        $c1++;
                        $value1 += floatval($item->value3);
                    }
                    if($item->value4>0){
                        $c1++;
                        $value1 += floatval($item->value4);
                    }
                    if($item->value5>0){
                        $c1++;
                        $value1 += floatval($item->value5);
                    }
                    if($item->value6>0){
                        $c1++;
                        $value1 += floatval($item->value6);
                    }
                }

            }
        }

        $old = 0;
        $new = 0;
        if($c!=0){
            $new = $value/$c;
        }
        if($c1!=0){
            $old = $value1/$c1;
        }
        if($c==0 || $c1==0){
            return array('diff'=>0,'new'=>$new,'p'=>0);
        }
        /*
        if($commoditycode=="11002" && $marketcode == "T01"){
            dd(array('diff'=>($new-$old),'new'=>$new,'p'=>(($new-$old)/$old)*100,'tmp1'=>$tmp1,'tmp2'=>$tmp2,"value1"=>$value."/".$c,"value2"=>$value1."/".$c1));
        }
        */
        return array('diff'=>($new-$old),'new'=>$new,'p'=>(($new-$old)/$old)*100);

    }
    function monthkhmer($i)
    {
        $mon = array("មករា", "កុម្ភៈ", "មិនា","មេសា","ឧសភា","មិថុនា","កក្កដា","សីហា","កញ្ញា","តុលា","វិច្ឆិកា","ធ្នូ");
        return $mon[$i-1];
    }

    public function exportLatestProductsUpdates($locale, $maxAge)
    {
        $baseSql = "
        FROM
        
        (
            SELECT
            commoditycode, unitcode, price as p1, date as d1
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE
                GROUP BY unitcode, commoditycode, YEAR(date), MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY o.commoditycode, o.date DESC
            ) a
            where RowNumber = 1
        ) q1
        
        LEFT JOIN
        
        (
            SELECT
            commoditycode, unitcode, price as p2, date as d2
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE
                GROUP BY unitcode, commoditycode, YEAR(date), MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY o.commoditycode, o.date DESC
            ) b
            where RowNumber = 2
        ) q2
        
        ON q1.commoditycode = q2.commoditycode
        
        LEFT JOIN amiscommoditylocale 
        ON q1.commoditycode = amiscommoditylocale.commoditycode 
        LEFT JOIN amisunitlocale 
        ON q1.unitcode = amisunitlocale.unitcode 
        
        WHERE 
        amiscommoditylocale.cultureid = $locale
        AND
        amisunitlocale.cultureid = $locale
        ";

        $querySql = "
        SELECT 
            amiscommoditylocale.name as name,
            amisunitlocale.shortname as unit,
            p1 as latestPrice,
            d1 as latestUpdate,
            p2 as previousPrice,
            d2 as previousUpdate
    
        $baseSql
    
        ";

        $countSql = "
        SELECT count(*) as c
        $baseSql
        ";
        $result =  DB::select($querySql);
        $count = DB::select($countSql);
        $commodities = array();
        //$arr = explode(":",$count[0]."");
        //dd($count[0]->c);
        foreach ($result as $row) {
            $commodities[] = array(
                'name' => $this->textToUnicode($row->name),
                'unit' => $row->unit,
                'latestPrice' => $row->latestPrice,
                'latestUpdate' => $row->latestUpdate,
                'previousPrice' => $row->previousPrice,
                'previousUpdate' => $row->previousUpdate
            );
        }
//        dd($commodities);
        return array(
            $commodities,
            $count[0]->c
        );
    }
    function textToUnicode($text) {
        if (preg_match('/^\&\#/', trim($text))) {
            return html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
        }
        return $text;
    }

    public function export_excel($current = 1)
    {

        // Execute the query used to retrieve the data. In this example
        // we're joining hypothetical users and payments tables, retrieving
        // the payments table's primary key, the user's first and last name,
        // the user's e-mail address, the amount paid, and the payment
        // timestamp.
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : $current;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;

        $recent_p = $this->exportLatestProductsUpdates($locale, $maxAge);

        // Initialize the array which will be passed into the Excel
        // generator.
//        $pricesArray = [];
//        dd($recent_p);

        // Define the Excel spreadsheet headers
        if($locale == 1)
        {
            $pricesArray[] = array(
                'Commodity Type',
                'Date of Report',
                'Price',
                'Unit'
            );
        }
        else
        {
            $pricesArray[] = array(
                'ប្រភេទទំនិញ',
                'កាលបរិច្ឆេទនៃរបាយការណ៍',
                'តម្លៃ',
                'ឯកតា'
            );
        }

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($recent_p[0] as $item) {
            $pricesArray[] = array(
                $item['name'],
                $item['latestUpdate'],
                $item['latestPrice'],
                $item['unit']
            );
//            dd($pricesArray);
        }

        // Generate and return the spreadsheet
        Excel::create('recent_price', function($excel) use ($pricesArray) {
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($pricesArray) {
                $sheet->fromArray($pricesArray);
            });

        })->download('csv');
    }

}
