<?php

namespace App\Http\Controllers\Api;

use App\AmisData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AmisCategoryLocale;
use App\AmisCategory;
use App\AmisCommodity;
use App\AmisCommodityLocale;
use App\AmisMarket;
use App\AmisMarketLocale;
use App\AmisRegion;
use App\AmisRegionLocale;
use App\Trigger;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{

    public function index(){

        $triggers = Trigger::all();
        $result = array();
        foreach ($triggers as $item){
            if($item->action=="insert" || $item->action=="update"){
                $data = DB::table("amisdata")->where("transactioncode",$item->primary_id)->where("commoditycode",$item->sub_id)->first();
                $result[] = array(
                    "action"=>$item->action,
                    "name"=>$item->name,
                    "data"=>$data,
                    "primary_id"=>$item->primary_id,
                    "sub_id"=>$item->sub_id
                );
            }else{
                $result[] = array(
                    "action"=>$item->action,
                    "name"=>$item->name,
                    "data"=>null,
                    "primary_id"=>$item->primary_id,
                    "sub_id"=>$item->sub_id
                );
            }



        }
        Trigger::truncate();
        return $result;
    }

    public function recieve(Request $request){

        $data = json_decode($request->data);
        //return $data;
        $arr = array(
            "delete"=>0,
            "insert/update"=>0,
            "fail"=>array("count"=>0,"message"=>array())
        );
        foreach ($data as $item){

            try{
                switch ($item->name){
                    case "categories":
                        $value = (int)trim($item->data->code," ");
                        //return $value;
                        if($value<10){
                            $categorycode = "00".$value;
                        }else{
                            $categorycode = "0".$value;
                        }

                        switch ($item->action){
                            case "delete":
                                AmisCategory::where('categorycode',$item->primary_id)->delete();
                                AmisCategoryLocale::where('categorycode',$item->primary_id)->delete();
                                $arr["delete"] = $arr["delete"]+1;
                                break;
                            default:
                                $this->addCategory($categorycode,$item->data->name_en,$item->data->name_kh);
                                $arr["insert/update"] = $arr["insert/update"]+1;
                        }
                        break;
                    case "comodities":

                        switch ($item->action){
                            case "delete":
                                AmisCommodity::where('commoditycode',$item->primary_id)->delete();
                                AmisCommodityLocale::where('commoditycode',$item->primary_id)->delete();
                                $arr["delete"] = $arr["delete"]+1;
                                break;
                            default:
                                $value = (int)trim($item->data->category_code," ");
                                if($value<10){
                                    $categorycode = "00".$value;
                                }else{
                                    $categorycode = "0".$value;
                                }
                                $this->addComodity($item->data->code,$categorycode,$item->data->name_en,$item->data->name_kh);
                                $arr["insert/update"] = $arr["insert/update"]+1;
                        }
                        break;
                    case "markets":
                        //return $item->data->code;
                        switch ($item->action){
                            case "delete":
                                AmisMarket::where('marketcode',$item->primary_id)->delete();
                                AmisMarketLocale::where('marketcode',$item->primary_id)->delete();
                                $arr["delete"] = $arr["delete"]+1;
                                break;
                            default:
                                $this->addMarket($item->data->code,$item->data->region_code,$item->data->name_en,$item->data->name_kh);
                                $arr["insert/update"] = $arr["insert/update"]+1;
                        }
                        break;
                    case "regions":
                        switch ($item->action){
                            case "delete":
                                AmisRegion::where('regioncode',$item->primary_id)->delete();
                                AmisRegionLocale::where('regioncode',$item->primary_id)->delete();
                                $arr["delete"] = $arr["delete"]+1;
                                break;
                            default:
                                $this->addRegion($item->data->code,$item->data->code,$item->data->name_en,$item->data->name_en);
                                $arr["insert/update"] = $arr["insert/update"]+1;
                        }
                        break;
                    case "data":
                        switch($item->action){
                            case "delete":
                                AmisData::where("transactioncode",$item->primary_id)->where("CommodityCode",$item->sub_id)->delete();
                                $arr["delete"] = $arr["delete"]+1;
                                break;
                            default:
                                $this->addData($item->data->transaction_code,$item->data->comodity_code,$item->data->market_code,$item->data->origin_code,$item->data->origin_code,$item->data->dataseries_code,$item->data->unite_code,$item->data->mkt_date,$item->data->value1,$item->data->value2,$item->data->value3);
                                $arr["insert/update"] = $arr["insert/update"]+1;
                        }
                        break;
                    default:
                        //return "not match table!";
                }
            }catch (\Exception $ex){
                //return $ex->getMessage();
                $arr["fail"]["count"] = $arr["fail"]["count"]+1;
                $arr["fail"]["message"][] = $ex->getMessage();
            }
        }
        return $arr;
    }

    public function addCategory($categorycode,$name_en,$name_kh){
        $categoryLocaleEn = new AmisCategoryLocale();
        $categoryLocaleKh = new AmisCategoryLocale();
        $category = new AmisCategory();
        if(AmisCategory::where("categorycode",$categorycode)->count()>0){
            $categoryLocaleEn = AmisCategoryLocale::where("categorycode",$categorycode)->where("cultureid",1)->first();
            $categoryLocaleEn->name=$name_en;
            $categoryLocaleEn->save();

            $categoryLocaleKh = AmisCategoryLocale::where("categorycode",$categorycode)->where("cultureid",2)->first();
            $categoryLocaleKh->name=$name_kh;
            $categoryLocaleKh->save();

        }else{

            $category->categorycode = $categorycode;
            $category->save();

            $categoryLocaleEn->cultureid=1;
            $categoryLocaleEn->categorycode=$categorycode;
            $categoryLocaleEn->name=$name_en;
            $categoryLocaleEn->locale="en-US";
            $categoryLocaleEn->save();

            $categoryLocaleKh->cultureid=2;
            $categoryLocaleKh->categorycode=$categorycode;
            $categoryLocaleKh->name=$name_kh;
            $categoryLocaleKh->locale="km-KH";
            $categoryLocaleKh->save();


        }

    }
    public function addComodity($commoditycode,$categorycode,$name_en,$name_kh){

        $localeEn = new AmisCommodityLocale();
        $localeKh = new AmisCommodityLocale();
        $item = new AmisCommodity();
        if(AmisCommodity::where("commoditycode",$commoditycode)->count()>0){

            //return $commoditycode;
            $item = AmisCommodity::where("commoditycode",$commoditycode)->first();
            $item->categorycode = $categorycode;
            $item->save();

            if(AmisCommodityLocale::where("commoditycode",$commoditycode)->where("cultureid",1)->count()>0){
                $localeEn = AmisCommodityLocale::where("commoditycode",$commoditycode)->where("cultureid",1)->first();
                $localeEn->name=$name_en;
                $localeEn->locale="en-US";
                $localeEn->save();

            }else{
                $localeEn->cultureid=1;
                $localeEn->commoditycode=$commoditycode;
                $localeEn->name=$name_en;
                $localeEn->locale="en-US";
                $localeEn->save();
            }

            if(AmisCommodityLocale::where("commoditycode",$commoditycode)->where("cultureid",2)->count()>0){
                $localeKh = AmisCommodityLocale::where("commoditycode",$commoditycode)->where("cultureid",2)->first();
                $localeKh->name=$name_kh;
                $localeKh->locale="km-KH";
                $localeKh->save();
            }else{
                $localeKh->cultureid=2;
                $localeKh->commoditycode=$commoditycode;
                $localeKh->name=$name_kh;
                $localeKh->locale="km-KH";
                $localeKh->save();
            }




        }else{

            $item->commoditycode = $commoditycode;
            $item->categorycode = $categorycode;
            $item->printflag = "1";
            $item->save();

            $localeEn->cultureid=1;
            $localeEn->commoditycode=$commoditycode;
            $localeEn->name=$name_en;
            $localeEn->locale="en-US";
            $localeEn->save();

            $localeKh->cultureid=2;
            $localeKh->commoditycode=$commoditycode;
            $localeKh->name=$name_kh;
            $localeKh->locale="km-KH";
            $localeKh->save();


        }

    }
    public function addMarket($marketcode,$regioncode,$name_en,$name_kh){
        //$query1 = "INSERT INTO amismarket(marketcode, regioncode, printflag, exportflag, archiveflag) VALUES ('$marketcode', '$regioncode', '1', '0', '0')";
        //$query2 = "INSERT INTO amismarketlocale(cultureid, marketcode, name) VALUES ('1', '$marketcode', '$name_en')";
        //$query3 = "INSERT INTO amismarketlocale(cultureid, marketcode, name) VALUES ('2', '$marketcode', '$name_en')";

        $localeEn = new AmisMarketLocale();
        $localeKh = new AmisMarketLocale();
        $item = new AmisMarket();
        if(AmisMarket::where("marketcode",$marketcode)->count()>0){

            $item = AmisMarket::where("marketcode",$marketcode)->first();
            $item->regioncode = $regioncode;
            $item->save();

            $localeEn = AmisMarketLocale::where("marketcode",$marketcode)->where("cultureid",1)->first();
            $localeEn->name=$name_en;
            $localeEn->save();

            $localeKh = AmisMarketLocale::where("marketcode",$marketcode)->where("cultureid",2)->first();
            $localeKh->name=$name_kh;
            $localeKh->save();

        }else{
            $item->marketcode = $marketcode;
            $item->regioncode = $regioncode;
            $item->printflag = "0";
            $item->exportflag = "0";
            $item->archiveflag = "0";
            $item->save();

            $localeEn->cultureid=1;
            $localeEn->marketcode=$marketcode;
            $localeEn->name=$name_en;
            $localeEn->save();

            $localeKh->cultureid=2;
            $localeKh->marketcode=$marketcode;
            $localeKh->name=$name_kh;
            $localeKh->save();
        }
    }
    public function addRegion($regioncode,$shortname,$name_en,$name_kh){

        //$query1="insert into amisregionlocale values(1,'$regioncode','$name_en','$shortname')";
        //$query2="insert into amisregionlocale values(2,'$regioncode','$name_kh','$shortname')";
        //$query3="insert into amisregion values('$regioncode','KH')";

        $localeEn = new AmisRegionLocale();
        $localeKh = new AmisRegionLocale();
        $item = new AmisRegion();
        if(AmisRegion::where("regioncode",$regioncode)->count()>0){

            $item = AmisRegion::where("regioncode",$regioncode)->first();
            $item->regioncode = $regioncode;
            $item->countrycode = "KH";
            $item->save();

            if(AmisRegionLocale::where("regioncode",$regioncode)->where("cultureid",2)->count()>0){
                $localeKh = AmisRegionLocale::where("regioncode",$regioncode)->where("cultureid",2)->first();
                $localeKh->name=$name_kh;
                $localeKh->shortname=$shortname;
                $localeKh->save();
            }else{
                $localeKh->cultureid=2;
                $localeKh->regioncode=$regioncode;
                $localeKh->name=$name_kh;
                $localeKh->shortname=$shortname;
                $localeKh->save();
            }


            if(AmisRegionLocale::where("regioncode",$regioncode)->where("cultureid",1)->count()>0){
                $localeEn = AmisRegionLocale::where("regioncode",$regioncode)->where("cultureid",1)->first();
                $localeEn->name=$name_en;
                $localeEn->shortname=$shortname;
                $localeEn->save();
            }else{
                $localeEn->cultureid=1;
                $localeEn->regioncode=$regioncode;
                $localeEn->name=$name_en;
                $localeEn->shortname=$shortname;
                $localeEn->save();
            }


        }else{

            $item->regioncode = $regioncode;
            $item->countrycode = "KH";
            $item->save();

            $localeEn->cultureid=1;
            $localeEn->regioncode=$regioncode;
            $localeEn->name=$name_en;
            $localeEn->shortname=$shortname;
            $localeEn->save();

            $localeKh->cultureid=2;
            $localeKh->regioncode=$regioncode;
            $localeKh->name=$name_kh;
            $localeKh->shortname=$shortname;
            $localeKh->save();

        }

    }
    public function addData($transactioncode,$CommodityCode,$MarketCode,$DataSourceCode,$OriginCode,$DataSeriesCode,$UnitCode,$Date,$Value1,$Value2,$Value3){
        //$prval = intval($item->value);
        //$sql = 'INSERT INTO amisdata(transactioncode,CommodityCode, GradeCode, MarketCode, DataSourceCode, OriginCode, DataSeriesCode, UnitCode, Date, Value1, UserName, UserTypeID)
        //                    VALUES ("'.$item->transcode.'","'.$item->ccode.'", "NS", "'.$item->mcode.'", "IMP","NS", "'.$item->dscode.'","'.$item->unitcode.'", "'.$item->date.'", '.$prval.', "NS", 1)';
        $item = new AmisData();
        if(AmisData::where("transactioncode",$transactioncode)->where("CommodityCode",$CommodityCode)->count()>0){
            $item = AmisData::where("transactioncode",$transactioncode)->where("CommodityCode",$CommodityCode)->first();
            $item->GradeCode = "NS";
            $item->MarketCode = $MarketCode;
            $item->DataSourceCode = $DataSourceCode;
            $item->OriginCode = $OriginCode;
            $item->DataSeriesCode = $DataSeriesCode;
            $item->UnitCode = $UnitCode;
            $item->Date = $Date;
            $item->Value1 = $Value1;
            $item->Value2 = $Value2;
            $item->Value3 = $Value3;
            $item->UserName = "NS";
            $item->UserTypeID = 1;
            $item->save();
        }else{
            $item->transactioncode=$transactioncode;
            $item->CommodityCode=$CommodityCode;
            $item->GradeCode = "NS";
            $item->MarketCode = $MarketCode;
            $item->DataSourceCode = $DataSourceCode;
            $item->OriginCode = $OriginCode;
            $item->DataSeriesCode = $DataSeriesCode;
            $item->UnitCode = $UnitCode;
            $item->Date = $Date;
            $item->Value1 = $Value1;
            $item->Value2 = $Value2;
            $item->Value3 = $Value3;
            $item->UserName = "NS";
            $item->UserTypeID = 1;
            $item->save();
        }


    }

}
