<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\Home\HomeRepository;
use Vanguard\Support\Traits\HomePageTrait;

class HomeController extends Controller
{
    use HomePageTrait;

    public function __construct(private HomeRepository $home)
    {
    }

    public function index(): \Inertia\Response
    {
        return Inertia::render('Home/Home');
    }

    public function latestProduct()
    {
        $commodities = $this->home->latestProduct();
        dd($commodities);

        return $commodities;
    }

    public function latestProductExport(): string
    {
        $start_col1 = "";
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;

        $limit = 12;
        if ($locale == 1) {
            $start_col1 = '<thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><tbody>';
        } else {
            $start_col1 = '<thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><tbody>';
        }

        $commodities = $this->getLatestProductsUpdatesExport($locale, $maxAge);
        $nextStart = $start + $limit;
        $linkClass = "float-right";

        if ($start === 0 && $commodities[1] <= $limit) {
            $linkClass = "hidden";
        } else {
            if ($start + $limit >= $commodities[1]) {
                $nextStart = $start - $limit;
                $linkClass = "float-left";
            }
        }
        $row1 = "";
        $i = 0;
        foreach ($commodities[0] as $commodity) {
            $class = 'fa-sort-up';
            $style = 'color:green;';

            if ($commodity['previousPrice'] > $commodity['latestPrice']) {
                $class = 'fa-sort-down';
                $style = 'color:red;';
            }
            $row1 = $row1 . "<tr><td>" . $commodity['name'] . "</td><td style='text-align:center;'>" . date_format(date_create($commodity['latestUpdate']), 'd/m/Y') . "</td><td style='text-align:right;'>" . number_format($commodity['latestPrice'], 2) . " KHR/" . $commodity['unit'] . " <span class='fa " . $class . "' style='" . $style . "'></span></td></tr>";
            $i++;

        }
        $end_col1 = "</tbody>";

        return $start_col1 . $row1 . $end_col1;
    }

    public function monthly($dataseriescode, $cultureid): array
    {
        $startdate = Carbon::now()->subMonth();
        $startdate->day = 1;
        $enddate = Carbon::now();
        $commodities = DB::connection('tmp')
            ->table('comodities')
            ->where("dataserries_code", 1)
            ->get();
        $makets = DB::connection('tmp')
            ->table('data')
            ->where('mkt_date', '>=', $startdate)
            ->where('mkt_date', '<=', $enddate)
            ->where('dataseries_code', $dataseriescode)
            ->orderBy('market_code', 'ASC')
            ->orderBy('mkt_date', 'ASC')
            ->select('market_code')
            ->groupBy('market_code')
            ->get();
        $arr = $makets->pluck('market_code');

        $sample = Db::connection('tmp')
            ->table('data')
            ->whereIn('market_code', $arr)
            ->where('mkt_date', '>=', $startdate)
            ->where('mkt_date', '<=', $enddate)
            ->where('dataseries_code', $dataseriescode)
            ->where('origin_code', '!=', "SMS")
            ->get();
        session_start();
        $_SESSION['alldata'] = $sample;
        $list = array();
        foreach ($makets as $item) {
            $list1 = array();
            $test = false;
            foreach ($commodities as $item1) {
                $commodity = $this->find($item1->code, $item->market_code);
                $list1[] = array(
                    'name' => $cultureid == 2 ? $item1->name_kh : $item1->name_en,
                    'diff' => $commodity['diff'],
                    'new' => $commodity['new'],
                    'p' => $commodity['p']
                );
                if ($commodity['diff'] != 0) {
                    $test = true;
                }
            }
            if ($test) {
                $market = Db::connection('tmp')
                    ->table('markets')
                    ->where("code", $item->market_code)
                    ->first();
                $list[] = array(
                    "market" => $market,
                    "region" => Db::connection('tmp')->table('regions')->where("code", $market->region_code)->first(),
                    "commodity" => $list1
                );
            }
        }

        return $list;
    }


    public function price(): array
    {
        $locale = $_GET['locale'];
        $commodityCode = $_GET['commodityCode'];
        $commodityCode1 = $_GET['commodityCode1'];
        $commodityCode2 = $_GET['commodityCode2'];
        $dataseries = $_GET['dataseries'];
        $maxAge = $_GET['maxAge'];

        $sql = "SELECT data.comodity_code,comodities.name_en,comodities.name_kh,mkt_date,value1 as price,data.id as dataid FROM data LEFT JOIN comodities ON data.comodity_code = comodities.code WHERE data.comodity_code IN($commodityCode,$commodityCode1,$commodityCode2) AND data.dataseries_code = '$dataseries' AND data.origin_code!='SMS' AND data.value1>0";

        if ($maxAge !== null) {
            $sql .= " AND mkt_date >= DATE_SUB(NOW(),INTERVAL $maxAge YEAR)";
        }

        $sql .= " GROUP BY YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)";
        $sql .= " ORDER BY mkt_date ASC";

        $result = DB::connection('tmp')->select($sql);
        $prices = array();
        foreach ($result as $row) {
            if (!isset($prices[$row->comodity_code])) {
                $prices[$row->comodity_code] = array(
                    'code' => $row->comodity_code,
                    'name' => $this->textToUnicode($locale == 2 ? $row->name_kh : $row->name_en),
                    'prices' => array()
                );
            }
            $prices[$row->comodity_code]['prices'][] = array(
                'date' => $row->mkt_date,
                'price' => $row->price,
                'id' => $row->dataid,
            );
        }

        return array_values($prices);
    }

    public function categories(): \Illuminate\Support\Collection
    {
        $lang = request()->get("language") ?? 1;
        $name = $lang == 1 ? "name_kh" : "name_en";
        return DB::connection('tmp')
            ->table("categories as c")
            ->orderBy("order")
            ->select("id", DB::raw("TRIM(code) as code"), $name . " as name", "is_default")
            ->get();
    }

    public function commodities($categoryCode): \Illuminate\Support\Collection
    {
        $lang = request()->get("language") ?? 1;
        $name = $lang == 1 ? "name_kh" : "name_en";
        return DB::connection('tmp')
            ->table("comodities as c")
            ->where("category_code", $categoryCode)
            ->orderBy("order")
            ->select("id", DB::raw("TRIM(code) as code"), $name . " as name", "is_default")
            ->get();
    }

}
