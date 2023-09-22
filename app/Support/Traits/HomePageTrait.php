<?php

namespace Vanguard\Support\Traits;

use Carbon\Carbon;
use DB;

trait HomePageTrait
{
    protected function findCommodity($commoditycode, $marketcode, $allData): array
    {
        $c = 0;
        $c1 = 0;
        $value = 0;
        $value1 = 0;
        $date = Carbon::now();
        $date->day = 1;

        foreach ($allData as $item) {
            if (($item->comodity_code == $commoditycode) && ($item->market_code == $marketcode)) {
                if ($date->diffInHours(Carbon::parse($item->mkt_date), false) > 0) {
                    if ($item->value1 > 0) {
                        $c++;
                        $value += floatval($item->value1);
                    }
                    if ($item->value2 > 0) {
                        $c++;
                        $value += floatval($item->value2);
                    }
                    if ($item->value3 > 0) {
                        $c++;
                        $value += floatval($item->value3);
                    }

                } else {
                    if ($item->value1 > 0) {
                        $c1++;
                        $value1 += floatval($item->value1);
                    }
                    if ($item->value2 > 0) {
                        $c1++;
                        $value1 += floatval($item->value2);
                    }
                    if ($item->value3 > 0) {
                        $c1++;
                        $value1 += floatval($item->value3);
                    }
                }
            }
        }

        $old = 0;
        $new = 0;
        if ($c != 0) {
            $new = $value / $c;
        }
        if ($c1 != 0) {
            $old = $value1 / $c1;
        }

        if ($c == 0 || $c1 == 0) {
            return [
                'diff' => 0,
                'new' => $new,
                'p' => 0,
            ];
        }
        return [
            'diff' => ($new - $old),
            'new' => $new,
            'p' => (($new - $old) / $old) * 100,
        ];
    }

    private function textToUnicode($text)
    {
        if (preg_match('/^\&\#/', trim($text))) {
            return html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
        }

        return $text;
    }

}
