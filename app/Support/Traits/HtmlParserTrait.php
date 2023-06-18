<?php

namespace Vanguard\Support\Traits;

use Vanguard\Services\Parser\BodyParser;
use Vanguard\Support\Enum\DeviceType;

trait HtmlParserTrait
{
    private function homePageParser($bronze, $posts, $isipadTopic, $pin_news, $page): string
    {
        $device = detectDevice();
        if ($device == DeviceType::DESKTOP) {
            //ADS
            $st = '<div class="news"> <div class="row pb-3">
                <div class="col-12 pb-4">';
            if ($bronze != null)
                $st .= '<a href="' . $bronze->link . '"><img src="' . url('storage/' . $bronze->image) . '" alt="" class="w-100"></a>';
            $st .= '</div>';

            //PIN NEW
            if ($page <= 3) {
                $st .= '<div class="game pb-4 col-12">
                        <div class="row ">';
                foreach ($pin_news as $item) {
                    $st .= '<div class="col-4">
                                    <a href="' . route('detail', $item->id) . '">
                                        <div class="card bd">
                                            <div class="card-img-t"
                                                style="background-image: url(' . detectImage($item) . ');  background-position: center;
                                            background-repeat: no-repeat; background-size: cover; width: 100%; height: 255px; justify-content: flex-end; transition: all .5s;">
                                            </div>
                                            <div class="card-pr">';
                    $st .= '<img src="' . url(getFileCDN('front/assets/img/pr.png')) . '" alt="">';
                    $st .= '</div>
                                            <div class="text-cate text-left">
                                                <h4>' . $item->title . '</h4>
                                                <small>ដោយ​ ៖ <span class="color-o">' . $item->by . '</span> | <span>' . calculateMinutes($item->created_at) . '</span></small>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                }
                $st .= '</div>
                    </div>';
            }

            //POST
            $st .= '<div class="col-8">
                    <div class="row">';
            foreach ($posts as $data) {
                $st .= '             <div class="col-12 pb-3">
                                <div class="row no-gutters bd-t">
                                    <div class="col-4">
                                        <a href="' . route('detail', $data->id) . '"><img src="' . getFileCDN($data->image) . '" alt="" class="w-100" style="height: 188px; object-fit: cover;"></a>
                                    </div>
                                    <div class="col-8">
                                        <div class="news-title">
                                            <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                                ' . $data->title . '
                                            </a></h5>
                                            <p>' . $data->excerpt . '</p>
                                            <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '
                                                    </span> </small>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            $st .= '            </div>
                    </div>
                    <div class="col-4"></div>
                </div></div>';
        } elseif ($device == DeviceType::PHONE) {
            //ADS
            $st = '<div class="ads pb-4">
                    <div class="row no-gutters">
                        <div class="col-12 ">';
            if ($bronze != null)
                $st .= '<a href="' . $bronze->link . '"><img src="' . url('storage/' . $bronze->image) . '" alt="" class="w-100"></a>';
            $st .= '      </div>
                    </div>
                </div>';

            //PIN NEWS
            if ($page <= 3) {
                $st .= '<div class="game pb-4">
                        <div class="row">';
                $i = 0;
                foreach ($pin_news as $item) {
                    $i++;
                    $temp = ($i < 3) ? "pb-3" : null;
                    $st .= '<div class="col-12 ' . $temp . '">
                        <a href="' . route('detail', $item->id) . '">
                            <div class="card bd-r">
                                <div class="card-img-top" style="background-image: url(' . detectImage($item) . ');  background-position: center;
                                    background-repeat: no-repeat; background-size: cover; width: 100%; height: 150px; justify-content: flex-end;">
                                </div>
                                <div class="card-pr">';
                    $st .= '<img src="' . url(getFileCDN('front/assets/img/pr.png')) . '" alt="">';
                    $st .= '</div>
                                <div class="text-cate text-left">
                                    <h4>' . $item->title . '</h4>
                                    <small>ដោយ​ ៖ <span class="color-o">' . $item->by . '</span> | <span>' . calculateMinutes($item->created_at) . '</span></small>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
                $st .= '</div></div>';
            }

            //POST
            $st .= '<div class="news">
                <div class="row">
                    <div class="col-12">
                        <div class="row">';
            foreach ($posts as $data) {
                $st .= '<div class="col-12 pb-3">
                                    <div class="row no-gutters bd-t">
                                        <div class="col-4">
                                            <a href="' . route('detail', $data->id) . '"><img src="' . detectImage($data) . '" alt="" class="w-100"></a>
                                        </div>
                                        <div class="col-8">
                                            <div class="news-title">
                                                <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                                    ' . $data->title . '
                                                </a></h5>
                                                <p>' . $data->excerpt . '</p>
                                                <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '</span> | <span><a href="' . route('detail', $data->id) . '"></a></span></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
            $st .= '      </div>
                    </div>
                </div>
            </div>';
        } else {
            if ($isipadTopic) {
                $col4 = "5";
                $col8 = "7";
            } else {
                $col4 = "4";
                $col8 = "8";
            }

            //ADS
            $st = '<div class="ads pb-4">
                <div class="row">
                    <div class="col-12 p-0">';
            if ($bronze != null)
                $st .= '<a href="' . $bronze->link . '"><img src="' . url('storage/' . $bronze->image) . '" alt="" class="w-100"></a>';
            $st .= '  </div>
                </div>
            </div>';

            //PIN NEWS
            if ($page <= 3) {
                $st .= '<div class="game pb-4">
                        <div class="row ">';
                $i = 0;
                foreach ($pin_news as $item) {
                    $i++;
                    $temp = ($i < 3) ? "pb-3" : null;
                    $st .= '<div class="col-12 ' . $temp . '">
                                    <a href="' . route('detail', $item->id) . '">
                                        <div class="card bd-r">
                                            <div class="card-img-t" style="background-image: url(' . detectImage($item) . ');  background-position: center;
                                                background-repeat: no-repeat; background-size: cover; width: 100%; height: 255px; justify-content: flex-end;">
                                            </div>
                                            <div class="card-pr">';
                    $st .= '<img src="' . url(getFileCDN('front/assets/img/pr.png')) . '" alt="">';
                    $st .= '</div>
                                            <div class="text-cate text-left">
                                                <h4>' . $item->title . '</h4>
                                                <small>ដោយ​ ៖ <span class="color-o">' . $item->by . '</span> | <span>' . calculateMinutes($item->created_at) . '</span></small>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                }
                $st .= '  </div>
                    </div>';
            }
            //POST
            $st .= '<div class="news">
                    <div class="row pb-3">
                        <div class="col-12">
                            <div class="row">';
            foreach ($posts as $data) {
                $st .= '<div class="col-12 pb-3">
                                        <div class="row no-gutters bd-t">
                                            <div class="col-' . $col4 . '">
                                                <a href="' . route('detail', $data->id) . '"><img src="' . detectImage($data) . '" alt="" class="w-100"></a>
                                            </div>
                                            <div class="col-' . $col8 . '">
                                                <div class="news-title">
                                                    <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                                        ' . $data->title . '
                                                    </a></h5>
                                                    <p>' . $data->excerpt . '​</p>
                                                    <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '</span> | <span><a href="' . route('detail', $data->id) . '"></a></span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            }
            $st .= '          </div>
                        </div>
                    </div>
                </div>';
        }

        return $st;
    }

    private function videoParser($bronze, $posts, $isipadTopic, $pin_news, $page): string
    {
        $device = detectDevice();
        if ($device == DeviceType::DESKTOP) {
            $st = '<div class="row vp-p">';
            foreach ($posts as $item) {
                $st .= '<div class="col-6 pb-4">
                        <button class="js-video-button depo-video" data-video-id="' . $item->video_link . '">
                            <div class="card bd">
                                <div class="card-img-t" style="background-image: url(' . getFileCDN($item->image) . ');  background-position: center;
                                        background-repeat: no-repeat; background-size: cover; width: 100%; height: 255px; justify-content: flex-end; transition: all .5s;">
                                </div>
                                <div class="card-body">
                                    <a href="#">
                                        <p class="card-text"> ' . $item->title . '</p>
                                    </a>
                                </div>
                            </div>
                        </button>
                    </div>';
            }
        } elseif ($device == DeviceType::PHONE) {
            $st = '<div class="row no-gutters">';
            foreach ($posts as $item) {
                $st .= '<div class="col-12  pb-4 ">
                    <div class="card bd bdr-t">
                        <button class="js-video-button" data-video-id="' . $item->video_link . '">
                            <img src="' . getFileCDN($item->image) . '" alt="..." class="img-thumbnail bd-r-t">
                        </button>
                        <div class="card-body">
                            <a href="#">
                                <p class="card-text"> ' . $item->title . ' </p>
                            </a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $st = '<div class="row no-gutters">';
            foreach ($posts as $item) {
                $st .= '<div class="col-6  p-3 ">
                    <div class="card bdr-t bd">
                        <button class="js-video-button" data-video-id="' . $item->video_link . '">
                            <img src="' . getFileCDN($item->image) . '" alt="..." class="img-thumbnail bd-r-t">
                        </button>
                        <div class="card-body">
                            <a href="#">
                                <p class="card-text"> ' . $item->title . ' </p>
                            </a>
                        </div>
                    </div>
                </div>';
            }
        }

        $st .= '</div>';

        return $st;
    }

    private function searchParser($posts)
    {
        $str = "";
        $device = detectDevice();
        if ($device == "desktop") {
            foreach ($posts as $data) {
                $str .= '<div class="col-12 pb-3">
                        <div class="row no-gutters bd-t">
                            <div class="col-4">
                                <a href="' . route('detail', $data->id) . '"><img src="' . getFileCDN($data->image) . '" alt="" class="w-100" style="height: 188px; object-fit: cover;"></a>
                            </div>
                            <div class="col-8">
                                <div class="news-title">
                                    <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                        ' . $data->title . '
                                    </a></h5>
                                    <p>' . $data->excerpt . '</p>
                                    <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '
                                            </span> | <span><a href="' . route('detail', $data->id) . '"></a></span></small>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } elseif ($device == "mobile") {
            foreach ($posts as $data) {
                $str .= '<div class="col-12 pb-3">
                        <div class="row no-gutters bd-t">
                            <div class="col-4">
                                <a href="' . route('detail', $data->id) . '"><img src="' . detectImage($data) . '" alt="" class="w-100"></a>
                            </div>
                            <div class="col-8">
                                <div class="news-title">
                                    <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                        ' . $data->title . '
                                    </a></h5>
                                    <p>' . $data->excerpt . '</p>
                                    <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '</span> | <span><a href="' . route('detail', $data->id) . '"></a></span></small>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            $col4 = "4";
            $col8 = "8";
            foreach ($posts as $data) {
                $str .= '<div class="col-12 pb-3">
                        <div class="row no-gutters bd-t">
                            <div class="col-' . $col4 . '">
                                <a href="' . route('detail', $data->id) . '"><img src="' . detectImage($data) . '" alt="" class="w-100"></a>
                            </div>
                            <div class="col-' . $col8 . '">
                                <div class="news-title">
                                    <h5><a href="' . route('detail', $data->id) . '" class="n-ti">
                                        ' . $data->title . '
                                    </a></h5>
                                    <p>' . $data->excerpt . '​</p>
                                    <small>ដោយ​ ៖ <span class="color-o">' . $data->by . '</span> | <span>' . calculateMinutes($data->created_at) . '</span> | <span><a href="' . route('detail', $data->id) . '"></a></span></small>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }

        return $str;
    }

    private function splitHTML($html)
    {
        try {
            $paser = new BodyParser();
            $arr = $paser->parseString($html);

            $new_arr = array();
            foreach ($arr as $item) {
                if (urlencode($item["value"]) != "%C2%A0+" && urlencode($item["value"]) != "%C2%A0") {
                    $new_arr[] = $item;
                }
            }

            $h_index = round(count($new_arr) / 2) - 1;

            while ($new_arr[$h_index]["type"] == "img") {
                $h_index = $h_index + 1;
            }

            $value = (strlen($new_arr[$h_index]["value"]) > 200) ? substr($new_arr[$h_index]["value"], 0, 200) : $new_arr[$h_index]["value"];

            $type = $new_arr[$h_index]["type"];
            while (strpos($html, $value) == false || $type == "img") {
                $h_index = $h_index + 1;
                $value = (strlen(trim($new_arr[$h_index]["value"])) > 20) ? substr(trim($new_arr[$h_index]["value"]), 0, 20) : trim($new_arr[$h_index]["value"]);
                $type = $new_arr[$h_index]["type"];
            }
            $index = strpos($html, $value) - 3;

            $str1 = substr($html, 0, $index);
            $str2 = substr($html, $index, strlen($html) - $index);

            return [
                $str1,
                $str2
            ];
        } catch (\Exception $exception) {
            return [$html, ""];
        }
    }
}
