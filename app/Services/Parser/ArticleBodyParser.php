<?php

namespace Vanguard\Services\Parser;

class ArticleBodyParser
{
    public function parse($body)
    {
        $arrayBody = preg_split("/(\r\n|\n|\r)/", $body);
        $middleBodyLength = (int)round(count($arrayBody) / 2);

        $body1 = "";
        $body2 = "";

        foreach ($arrayBody as $index => $item) {
            if ($index <= $middleBodyLength) {
                $body1 .= $item;
            } else {
                $body2 .= $item;
            }
        }

        return [
            $body1,
            $body2
        ];
    }

}
