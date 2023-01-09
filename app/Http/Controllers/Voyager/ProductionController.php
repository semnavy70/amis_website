<?php

namespace App\Http\Controllers\Voyager;

use App\Product;
use App\ProductData;
use App\ProvinceProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProductionController extends Controller
{
    //

    public function index(){
        //return view();
        $data = Product::all();
        return view('vendor.voyager.products.index',["products"=>$data]);
    }
    public function browse($id){
        $product = Product::find($id);
        $data = ProductData::where("product",$product->code)->get();
        return view('vendor.voyager.products.browse',["product"=>$product,"data"=>$data]);
    }
    public function excel_data(Request $req){
        if($req->hasFile('excel')) {

            $req->excel->storeAs('excel', $req->excel->getClientOriginalName());

            $path = storage_path('app/excel/' . $req->excel->getClientOriginalName());
            $data = Excel::load($path, function ($reader) {
            })->get();
            //return $data;
            $result = array();
            foreach ($data as $sheet){
                $products = Product::where("code",$sheet->getTitle());
                if($products->count()>0){
                    $c = 0;
                    foreach ($sheet as $item){
                        $product_data = ProductData::where("product",$sheet->getTitle())->where("province_code",$item->procode)->where("type",$item->type);
                        $data = new ProductData();
                        if($product_data->count()){
                            $data = $product_data->first();
                        }
                        $data->province_code = $item->procode;
                        $data->type = $item->type;
                        $data->product = $sheet->getTitle();
                        $data->y2010 = $item->y2010;
                        $data->y2011 = $item->y2011;
                        $data->y2012 = $item->y2012;
                        $data->y2013 = $item->y2013;
                        $data->y2014 = $item->y2014;
                        $data->y2015 = $item->y2015;
                        $data->y2016 = $item->y2016;
                        $data->y2017 = $item->y2017;
                        $data->y2018 = $item->y2018;
                        $data->y2019 = $item->y2019;
                        $data->y2020 = $item->y2020;
                        $data->y2021 = $item->y2021;
                        $data->y2022 = $item->y2022;
                        $data->save();
                        $c++;
                    }
                    $result[$sheet->getTitle()] = $c;

                }
            }
            Session::flash('message',json_encode($result));
            return redirect()->back();

        }
    }

    public static function map(){
        //dd($view_type);
        $province = "TT";
        $crop = "EarlyWetRice";
        $type = "Production (MT)";
        $start = "y2010";
        $end = "y".Carbon::now()->year;
        if(isset($_GET["province"])){
            $province = $_GET["province"];
        }
        if(isset($_GET["crop"])){
            $crop = $_GET["crop"];
        }
        if(isset($_GET["type"])){
            $type = $_GET["type"];
        }
        if(isset($_GET["start"])){
            $start = $_GET["start"];
        }
        if(isset($_GET["end"])){
            $end = $_GET["end"];
        }
        $current = array(
            "province"=>$province,
            "crop"=>$crop,
            "type"=>$type,
            "start"=>$start,
            "end"=>$end
        );
        //dd($current);
        $provinces = ProvinceProduct::all();
        $provinces->load('translations');
        $products =  Product::all();
        $products->load("translations");

        //return $province;
        return view("vendor.voyager.products.map",["provinces"=>$provinces,"products"=>$products,"current"=>$current]);
    }
    public function getProduction(){


        $province = $_GET["province"];
        $crop = $_GET["crop"];
        $type = $_GET["type"];
        $start = $_GET["start"];
        $end = $_GET["end"];
        //$province."-".$crop."-".$type."-".$start."-".$end
        //SELECT `product`,`type`, SUM(`y2010`) as y2010 , SUM(`y2011`) as y2011 ,SUM(`y2012`) as y2012 ,SUM(`y2013`) as y2013 , SUM(`y2014`) as y2014 , SUM(`y2015`) as y2015 , SUM(`y2016`) as y2016 ,SUM(`y2017`) as y2017 ,SUM(`y2018`) as y2018 , SUM(`y2019`) as y2019 ,SUM(`y2020`) as y2020 ,SUM(`y2021`) as y2022 FROM `production_data` WHERE `product` = 'ricewet' GROUP BY type

        if($province=="0"){

            if($type=="Yield (Kg/Ha)"){

                $data = DB::select(DB::raw("SELECT `product`,`type`, avg(`y2010`) as y2010 , avg(`y2011`) as y2011 , avg(`y2012`) as y2012 , avg(`y2013`) as y2013 , avg(`y2014`) as y2014 , avg(`y2015`) as y2015 , avg(`y2016`) as y2016 , avg(`y2017`) as y2017 , avg(`y2018`) as y2018 , avg(`y2019`) as y2019 , avg(`y2020`) as y2020 , avg(`y2021`) as y2021 , avg(`y2022`) as y2022 FROM `production_data` WHERE `product` = '".$crop."' GROUP BY type"));
                //dd($data[1]->y2010);
                //return $data;
                $data[2]->y2010 = is_null($data[0]->y2010)?0:$data[2]->y2010;
                $data[2]->y2011 = is_null($data[0]->y2011)?0:$data[2]->y2011;
                $data[2]->y2012 = is_null($data[0]->y2012)?0:$data[2]->y2012;
                $data[2]->y2013 = is_null($data[0]->y2013)?0:$data[2]->y2013;
                $data[2]->y2014 = is_null($data[0]->y2014)?0:$data[2]->y2014;
                $data[2]->y2015 = is_null($data[0]->y2015)?0:$data[2]->y2015;
                $data[2]->y2016 = is_null($data[0]->y2016)?0:$data[2]->y2016;
                $data[2]->y2017 = is_null($data[0]->y2017)?0:$data[2]->y2017;
                $data[2]->y2018 = is_null($data[0]->y2018)?0:$data[2]->y2018;
                $data[2]->y2019 = is_null($data[0]->y2019)?0:$data[2]->y2019;
                $data[2]->y2020 = is_null($data[0]->y2020)?0:$data[2]->y2020;
                $data[2]->y2021 = is_null($data[0]->y2021)?0:$data[2]->y2021;
                $data[2]->y2022 = is_null($data[0]->y2022)?0:$data[2]->y2022;
                $data = array(
                    "product"=>$data[2]->product,
                    "type"=>$data[2]->type,
                    "y2010"=>$data[2]->y2010,
                    "y2011"=>$data[2]->y2011,
                    "y2012"=>$data[2]->y2012,
                    "y2013"=>$data[2]->y2013,
                    "y2014"=>$data[2]->y2014,
                    "y2015"=>$data[2]->y2015,
                    "y2016"=>$data[2]->y2016,
                    "y2017"=>$data[2]->y2017,
                    "y2018"=>$data[2]->y2018,
                    "y2019"=>$data[2]->y2019,
                    "y2020"=>$data[2]->y2020,
                    "y2021"=>$data[2]->y2021,
                    "y2022"=>$data[2]->y2022,
                );
            }else{

                $data = DB::select("SELECT `product`,`type`, SUM(`y2010`) as y2010 , SUM(`y2011`) as y2011 ,SUM(`y2012`) as y2012 ,SUM(`y2013`) as y2013 , SUM(`y2014`) as y2014 , SUM(`y2015`) as y2015 , SUM(`y2016`) as y2016 ,SUM(`y2017`) as y2017 ,SUM(`y2018`) as y2018 , SUM(`y2019`) as y2019 ,SUM(`y2020`) as y2020 ,SUM(`y2021`) as y2021 ,SUM(`y2022`) as y2022 FROM `production_data` WHERE `product` = '".$crop."' AND `type`='".$type."' GROUP BY type LIMIT 1");
                dd($data);
                $data = $data[0];
                $data = array(
                    "product"=>$data->product,
                    "type"=>$data->type,
                    "y2010"=>$data->y2010,
                    "y2011"=>$data->y2011,
                    "y2012"=>$data->y2012,
                    "y2013"=>$data->y2013,
                    "y2014"=>$data->y2014,
                    "y2015"=>$data->y2015,
                    "y2016"=>$data->y2016,
                    "y2017"=>$data->y2017,
                    "y2018"=>$data->y2018,
                    "y2019"=>$data->y2019,
                    "y2020"=>$data->y2020,
                    "y2021"=>$data->y2021,
                    "y2022"=>$data->y2022,
                );

            }

        }else{

            $data = ProductData::where("province_code",$province)->where("type",$type)->where("product",$crop)->first();
        }

        //return $data;
        $product = Product::where("code",$crop)->first()->name;
        $unit = "HA";
        if($type=="Yield (Kg/Ha)"){
            $unit = "Kg/Ha";
        }
        if($type=="Production (MT)"){
            $unit = "MT";
        }
        $result = array(
            "code"=>$crop,
            "name"=>$product,
            "unit"=>$unit,
            "data"=>$this->getData($data,$start,$end)
        );


        return $result;

    }
    public  function getData($data,$start,$end){
        $s_year = substr($start,1)+0;
        $e_year = substr($end,1)+0;

        if(!is_array($data)){
            $data = $data->toArray();
        }
        $result = array();
        for ($i=$s_year;$i<=$e_year;$i++){
            $result[] = array(
                "date"=>$i,
                "value"=>$data["y".$i]
            );
        }
        return $result;
    }

}
