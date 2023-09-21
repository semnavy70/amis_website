<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Support\Traits\HomePageTrait;

class HomeController extends Controller
{
    use HomePageTrait;

    public function index(): \Inertia\Response
    {
        return Inertia::render('Home/Home');
    }

    public function latestRroduct(): string
    {
        $start_col1 = "";
        $start_col2 = "";
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 2;
        $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;
        $limit = 12;

        if ($locale == 1) {
            $start_col1 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily1"><thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><body>';
            $start_col2 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily2"><thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><body>';
        } else {
            $start_col1 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily1"><thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><body>';
            $start_col2 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily2"><thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><body>';
        }

        $commodities = $this->getLatestProductsUpdates($locale, $start, $limit, $maxAge);

        $nextStart = $start + $limit;
        $linkClass = "float-right";
        $linkLabel = 'Next <i class="fas fa-angle-double-right"></i>';

        if ($start === 0 && $commodities[1] <= $limit) {
            $linkClass = "hidden";
        } else {
            if ($start + $limit >= $commodities[1]) {
                $nextStart = $start - $limit;
                $linkClass = "float-left";
                $linkLabel = '<i class="fas fa-angle-double-left"></i> Prev';
            }
        }
        $row1 = "";
        $row2 = "";
        $i = 0;
        foreach ($commodities[0] as $commodity) {
            $class = 'fa-sort-up';
            $style = 'color:green;';

            if ($commodity['previousPrice'] > $commodity['latestPrice']) {
                $class = 'fa-sort-down';
                $style = 'color:red;';
            }
            if (($i % 2) == 1) {
                $row1 = $row1 . "<tr><td>" . $commodity['name'] . "</td><td style='text-align:center;'>" . date_format(date_create($commodity['latestUpdate']), 'd/m/Y') . "</td><td style='text-align:right;'>" . number_format($commodity['latestPrice'], 2) . " KHR/" . $commodity['unit'] . " <span class='fa " . $class . "' style='" . $style . "'></span></td></tr>";
            } else {
                $row2 = $row2 . "<tr><td>" . $commodity['name'] . "</td><td style='text-align:center;'>" . date_format(date_create($commodity['latestUpdate']), 'd/m/Y') . "</td><td style='text-align:right;'>" . number_format($commodity['latestPrice'], 2) . " KHR/" . $commodity['unit'] . " <span class='fa " . $class . "' style='" . $style . "'></span></td></tr>";
            }
            $i++;

        }
        $end_col1 = "</body></table></div>";
        $end_col2 = "</body></table></div>";
        $a = "<div class='col-md-12'><a href='#' data-start='" . $nextStart . "' data-limit='" . $limit . "' class='" . $linkClass . "' style='color: #707A1A;text-decoration: none;' onclick='LatestProductLoader.load(); return false;' id='LatestProductMore'>" . $linkLabel . "</a></div>";
        return "<div class='row'>" . $start_col1 . $row1 . $end_col1 . $start_col2 . $row2 . $end_col2 . $a . "</div>";
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


}
