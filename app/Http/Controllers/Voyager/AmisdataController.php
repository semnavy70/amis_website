<?php

namespace App\Http\Controllers\Voyager;

use App\AmisData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Session;

class AmisdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amis_data = AmisData::orderBy('date', 'desc')->paginate(15);

        $data = array(
            'amis_data' => $amis_data,
        );

//        dd($data);
        return view('vendor.voyager.amisdatas.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amis_data = AmisData::find($id);
        $data = array(
            'amis_data' => $amis_data
        );
        return view('vendor.voyager.amisdatas.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'value1' => 'required',
        ]);
        $data = array(
            'value1' => $request->value1,
        );

        AmisData::where('dataid', $id)->update($data);
        return redirect()->back()->with('msg', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AmisData::destroy($id);
        return redirect()->back();

    }
    public  function excel_amiss(Request $req){

        if($req->hasFile('excel')) {

            $req->excel->storeAs('excel', $req->excel->getClientOriginalName());

            $path = storage_path('app/excel/' . $req->excel->getClientOriginalName());
            $data = Excel::load($path, function ($reader) {
            })->get();

            $header = $data->first()->keys()->toArray();

            //  Start Import Process
            $STARTROW  = 1;
            $TRANSCODE = 0; $CCODE = 1; $VALUE = 2; $UNITCODE = 3; $MCODE = 4; $DATE = 5; $DSCODE = 6; $ORIGINCODE = 7;
            $haserror = false;
            $msgcol = array();

            if ($header[$TRANSCODE] == "transcode" && $header[$CCODE]== "ccode" && $header[$VALUE] == "value" && $header[$UNITCODE] == "unitcode" && $header[$MCODE] == "mcode" && $header[$DATE] == "date" && $header[$DSCODE] == "dscode" && $header[$ORIGINCODE] == "origincode"){
                $haserror = false;
            }else{
                $haserror = true;
            }
            //dd($haserror);
            if($haserror){
                $msgcol[]  = "Please check your header!";
                Session::flash('message',"Header Collumns មិនត្រឹមត្រូវ!");
                return redirect()->back();
            }

            $counter_update = 0;
            $counter_insert = 0;
            $counter_nonupdated = 0;
            $counter_error = 0;

            $spnum = 4;


            $sql = 'SELECT commoditycode FROM amiscommodity';
            $result=DB::select($sql);
            //dd(count($result));
            $ccodes=array();
            foreach ($result as $item){
                $ccodes[] = $item->commoditycode;
            }


            $sql = 'SELECT unitcode FROM amisunit';
            $result= DB::select($sql);
            $ucodes = array();
            foreach ($result as $item){
                $ucodes[] = $item->unitcode;
            }
            $sql = 'SELECT marketcode FROM amismarket';
            $result=DB::select($sql);
            $mcodes = array();
            foreach ($result as $item){
                $mcodes[] = $item->marketcode;
            }
            $time_exe = array();
            $mtime = microtime();
            $mtime = explode(" ",$mtime);
            $inittime = $mtime[1] + $mtime[0];
            $i = 0;
            foreach ($data as $item){


                $mtime = microtime();
                $mtime = explode(" ",$mtime);
                $mtime = $mtime[1] + $mtime[0];
                $starttime = $mtime;

                $haserror = false;// reset error status


                // Transactioncode: if it is empty or longer than 15
                if (($item->transcode == '') OR (strlen($item->transcode) > 15)){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: Transaction Code - '.$item->transcode.' is not correct.';
                }

                // CommodityCode: if it is empty or longer than 5
                if (($item->ccode == '') OR (strlen($item->ccode) > 5)){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: Commodity Code - '.$item->ccode.' is not correct. its length longer than 5';
                }else{
                    //Check if value is commoditycode
                    $searchvalue = $item->ccode;
                    if (!in_array($searchvalue,$ccodes)){
                        $haserror = true;
                        $msgcol[] = 'Error line '.$i.' in file: Commodity Code - '.$item->ccode.' is not exist in database';
                    }
                }

                // UnitCode: if it is empty or longer than 3
                if (($item->unitcode == '') OR (strlen($item->unitcode) > 3)){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: Unit Code - '.$item->unitcode.' is not correct';
                }else{
                    $searchvalue = $item->unitcode;
                    if (!in_array($searchvalue,$ucodes)){
                        $haserror = true;
                        $msgcol[] = 'Error line '.$i.' in file: Unit Code - '.$item->unitcode.' is not exist in database';
                    }
                }

                // MarketCode
                if (($item->mcode == '') OR (strlen($item->mcode) > 3)){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: Market Code - '.$item->mcode.' is not correct';
                }else{
                    // Check if value is marketcode: if it have correct martket value
                    $searchvalue = $item->mcode;
                    if (!in_array($searchvalue,$mcodes)){
                        $haserror = true;
                        $msgcol[] = 'Error line '.$i.' in file: Market code - '.$item->mcode.' is not exist in database';
                    }
                }

                // Date
                if ($item->date == '' || $item->date == null){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: The Date is incorrect.';
                }

                // DataseriesCode, WP or RP
                if ($item->dscode == '' OR ($item->dscode!="WP" AND $item->dscode != "RP" )){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: The data series code - '.$item->dscode.' is not correct';
                }

                // OriginCode
                if (($item->origincode == '') or (strlen($item->origincode) > 3)){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: The origin code - '.$item->origincode .' is not correct';
                }

                // Value: if value is zero or empty
                if ((intval($item->value)==0) OR (trim($item->value)=='')){
                    $haserror = true;
                    $msgcol[] = 'Error line '.$i.' in file: Value - '.$item->value.' is not correct';
                }
                //dd($msgcol);
                // check if data is allready in the database
                if (!$haserror){
                    $where   = array();
                    $where[] = 'transactioncode = "'.$item->transcode.'"';
                    $where[] = 'commoditycode = "'.$item->ccode.'"';
                    $where[] = 'marketcode = "'.$item->mcode.'"';
                    $where[] = 'origincode = "'.$item->origincode.'"';
                    $where[] = 'dataseriescode = "'.$item->dscode.'"';
                    $where[] = 'unitcode = "'.$item->unitcode.'"';
                    $where[] = 'date="'.$item->date.'"';
                    //$where[] = ''.intval($datarow[$VALUE]);
                    $where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

                    $sql = 'SELECT value1 FROM amisdata '.$where;
                    //dd($sql);
                    $price=DB::select($sql);
                    //dd($price);
                    // If data not in the database check if only the price has changed, if yes then update price
                    if (count($price)==0){// if record not exist
                        $prval = intval($item->value);
                        $sql = 'INSERT INTO amisdata(transactioncode,CommodityCode, GradeCode, MarketCode, DataSourceCode, OriginCode, DataSeriesCode, UnitCode, Date, Value1, UserName, UserTypeID) 
                            VALUES ("'.$item->transcode.'","'.$item->ccode.'", "NS", "'.$item->mcode.'", "IMP","NS", "'.$item->dscode.'","'.$item->unitcode.'", "'.$item->date.'", '.$prval.', "NS", 1)';

                        $status=DB::select($sql);

                        //if($status) $counter_insert = $counter_insert + 1;
                        //if(!$status) $msgcol[] = 'Error line '.$i.' in file: in inserting into table amisdata';
                        $sql = 'INSERT INTO amiscurrentdata(transactioncode,CommodityCode, GradeCode, MarketCode, DataSourceCode, OriginCode, DataSeriesCode, UnitCode, Date, Value1, UserName, UserTypeID) 
                            VALUES ("'.$item->transcode.'","'.$item->ccode.'", "NS", "'.$item->mcode.'", "IMP","NS", "'.$item->dscode.'","'.$item->unitcode.'", "'.$item->date.'", '.$prval.', "NS", 1)';
                        $status=DB::select($sql);
                        //if(!$status) $msgcol[] = 'Error line '.$i.' in file: in inserting into amiscurrentdata';
                    }else{
                        $newval = intval($item->value);//intval($datarow[$VALUE]);
                        $oldval = intval($price);
                        if ($oldval != $newval) {
                            $sql = 'UPDATE amisdata SET value1 = '.$newval.' '.$where ;
                            $status=DB::select($sql);
                            //dd($status);
                            $counter_update = $counter_update + 1;
                            //if(empty($status)) $msgcol[] = 'Error line '.$i.' in file in file: Update Price Failed.';
                            //$msgcol[] = 'SQL '.$line.': old=>'.$price.' and new=>'.$newval.' query=> '.$sql;
                            //$msgcol[] = 'SQL '.$line.': old=>'.$price.' and new=>'.$newval.' query=> '.$sql1;
                        }else{
                            $counter_nonupdated =  $counter_nonupdated + 1;
                            //$msgcol[] = 'SQL '.$line.': old=>'.$price.' and new=>'.$newval.' query=> '.$sql;
                        }
                    }
                }else{
                    $counter_error = $counter_error + 1;
                }

                $mtime = microtime();
                $mtime = explode(" ",$mtime); $mtime = $mtime[1] + $mtime[0]; $endtime = $mtime;
                $totaltime = ($endtime - $starttime); $telapse = $endtime - $inittime;
                $time_exe[] = 'Line:'.$i.'-'.$telapse." .This line was processed in ".$totaltime." seconds";
                $i++;

            }


            $frow = $data->first();
            $startpricedate = $frow->date;
            $endpricedate = $data[$i-1]->date;
            $starttransactioncode = $frow->transcode;
            $endtransactioncode = $data[$i-1]->transcode;
            $sql = "INSERT INTO uploadlog(uploaddate,startpricedate,endpricedate,starttransactioncode,endtransactioncode,inserts,updates,noupdates,errors) 
                VALUES (NOW(),'$startpricedate', '$endpricedate', '$starttransactioncode', '$endtransactioncode','$counter_insert', '$counter_update', '$counter_nonupdated', '$counter_error')";
            $status=DB::select($sql);

            $result   = array();
            $result[] = 'Total number of new prices: '.$counter_insert.'<br/>';
            $result[] = 'Total number of prices updated: '.$counter_update.'<br/>';
            $result[] = 'Total number of prices allready in the database: '.$counter_nonupdated.'<br/>';
            $result[] = 'Total number of prices not updated: '.$counter_error.'<br/>';
            $upinfo   = array('message'=>$result, 'error'=>$msgcol);

            //dd($msgcol);


            $msgcol = ( count( $msgcol ) ? '  '. implode( ' <br> ', $msgcol ) : '' );

            //return $result;
            Session::flash('message',"Data ".$counter_insert." Recodes inserted"."<br>Data ".$counter_update." Recodes updated"."<br>Data ".$counter_error." Recodes is error"."<br>".$msgcol);
            if(count($msgcol)>0){
                return "Data ".$counter_insert." Recodes inserted"."<br>Data ".$counter_update." Recodes updated"."<br>Data ".$counter_error." Recodes is error : "."<br>".$msgcol;
            }
            return redirect()->back();

        }
    }
}
