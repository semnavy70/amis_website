<?php

namespace App\Http\Controllers\Voyager;

use App\ProductExport;
use App\ProductExportDatum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProductionExportController extends Controller
{
    public static function index(){
        //dd($view_type);
        $product_export_id = 1;
        $start = "y2014";
        $end = "y".Carbon::now()->year;

        if(isset($_GET["product_export_id"])){
            $product_export_id = $_GET["product_export_id"];
        }
        if(isset($_GET["start"])){
            $start = $_GET["start"];
        }
        if(isset($_GET["end"])){
            $end = $_GET["end"];
        }
        $current = array(
            "product_export_id"=>$product_export_id,
            "start"=>$start,
            "end"=>$end
        );

        $products =  ProductExport::all();
        //return $province;
        return view("vendor.voyager.products.product_export",["products"=>$products,"current"=>$current]);
    }
    public function getProduction(){

        $product_id = $_GET["product_export_id"];
        $start = $_GET["start"];
        $end = $_GET["end"];
        $product = ProductExport::find($product_id);
        $data = ProductExportDatum::where("product_export_id",$product_id)->first();
        $data = array(
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


        $result = array(
            "name"=>$product->name,
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
