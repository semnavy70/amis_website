<?php


use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Vanguard\Support\Enum\DeviceType;

function getFileCDN($file)
{
    if(\Illuminate\Support\Str::contains($file,"http")){
        return  $file;
    }
    $path = 'https://storage.googleapis.com/indo-pacific/' . $file;

    return str_replace(' ', '', $path);
}

function frontUrl($path): string
{


    $path = str_replace(' ', '', $path);

    return "https://storage.googleapis.com/camboreport/front/" . $path;
}

function calculateMinutes($minutes)
{
    if (is_string($minutes)) {
        $minutes = Carbon::parse($minutes);
    }

    $result = $minutes->diffForHumans();
    $result = str_replace("seconds", "វិនាទី", $result);
    $result = str_replace("second", "វិនាទី", $result);
    $result = str_replace("minutes", "នាទី", $result);
    $result = str_replace("minute", "នាទី", $result);
    $result = str_replace("hours", "ម៉ោង", $result);
    $result = str_replace("hour", "ម៉ោង", $result);
    $result = str_replace("days", "ថ្ងៃ", $result);
    $result = str_replace("day", "ថ្ងៃ", $result);
    $result = str_replace("weeks", "សប្តាហ៍", $result);
    $result = str_replace("week", "សប្តាហ៍", $result);
    $result = str_replace("months", "ខែ", $result);
    $result = str_replace("month", "ខែ", $result);
    $result = str_replace("years", "ឆ្នាំ", $result);
    $result = str_replace("year", "ឆ្នាំ", $result);
    $result = str_replace(" ago", "មុន", $result);

    return $result;
}

function detectDevice(): string
{
    $agent = new Agent();
    $type = $agent->deviceType();

    if ($type == DeviceType::PHONE) {
        return DeviceType::PHONE;
    } elseif ($type == DeviceType::TABLET) {
        return DeviceType::TABLET;
    } elseif ($type == DeviceType::DESKTOP) {
        return DeviceType::DESKTOP;
    } else {
        return DeviceType::DESKTOP;
    }
}


function pinNewImage($data)
{
    if ($data->image_pin_news) {
        return getFileCDN($data->image_pin_news);
    }

    return detectImage($data);
}


function detectImage($data)
{
    $device = detectDevice();

    if ($device == DeviceType::DESKTOP) {
        return getFileCDN($data->image);
    } elseif ($device == DeviceType::PHONE) {
        if ($data->image_mobile == null) {
            return getFileCDN($data->image);
        } else {
            return getFileCDN($data->image_mobile);
        }
    } else {
        if ($data->image_tablet == null) {
            return getFileCDN($data->image);
        } else {
            return getFileCDN($data->image_tablet);
        }
    }
}

function detectThumbnail($data)
{
    if ($data->image_thumbnail != null)
        return getFileCDN($data->image_thumbnail);
    else
        return getFileCDN($data->image);
}

function cardTop($j, $content, $height, $yok = false): string
{
    if ($yok)
        $img = $content[$j]->image_pin_news != null ? $content[$j]->image_pin_news : $content[$j]->image;
    else
        $img = $content[$j]->image;
    $count = $content->count();
    $st = '
        <a href="' . route('detail', $content[$j]->id) . '">
            <div class="card bd-r">
                <div class="card-img-t"
                    style="background-image: url(';
    $st .= $j < $count ? getFileCDN($img) : null;
    $st .= ');  background-position: center;
                background-repeat: no-repeat; background-size: cover; width: 100%; height: ' . $height . 'px; justify-content: flex-end; transition: all .5s;">
                </div>
                <div class="card-pin">';
    $st .= '<img src="' . url(getFileCDN('front/assets/img/pin.png')) . '" alt="">
                </div>
                <div class="text-cate text-left"><h4>';
    $st .= $j < $count ? $content[$j]->title : null;
    $st .= '</h4>
                    <small>ដោយ​ ៖ <span class="color-o">';
    $st .= $j < $count ? $content[$j]->by : null;
    // $st .= '</span> | <span>';
    // $st .= $j < $count ? calculateMinutes($content[$j]->created_at) : null;
    $st .= '</span></small>
                </div>
            </div>
        </a>';

    return $st;
}

function isRoute($current_url, $item_url): string
{
    return $current_url == $item_url ? "active" : "";
}

function getAds($blogId, $categoryId, $listAds, $type)
{
    if ($type == "all") {
        $ads = $listAds->where("cat_ads_id", $categoryId)->where("blog_ads_id", $blogId);
    } else {
        $ads = $listAds->where("cat_ads_id", $categoryId)->where("blog_ads_id", $blogId)->first();
    }

    return $ads;
}

if (!function_exists('calculateDate')) {
    function calculateDate($modify, $date): string
    {
        return DateTime::createFromFormat('Y-m-d', $date)
            ->modify($modify)
            ->format('Y-m-d');
    }
}

if (!function_exists('sendMessage')) {
    function sendMessage($chatID, $messaggio, $token)
    {
        echo "sending message to " . $chatID . "\n";

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}


if (!function_exists('getPaginateUrl')) {
    function getPaginateUrl($page)
    {
        $request = request();
        $query = $request->all() ?? [];
        $query['page'] = $page;
        $url = $request->fullUrlWithQuery($query);

        return $url;
    }
}

if (!function_exists('dmYDate')) {
    function dmYDate($str)
    {
        return date("d-m-Y", strtotime($str));
    }
}

if (!function_exists('dmYHisADate')) {
    function dmYHisADate($str)
    {
        return date("d-m-Y h:i:s a", strtotime($str));
    }
}

if (!function_exists('currentUrl')) {
    function currentUrl(): string
    {
        return url()->current();
    }
}

if (!function_exists('getBodyText')) {
    function getBodyText($body): string
    {
        return str_replace("https://storage.googleapis.com/camboreport", "https://storage.cambo-report.com", $body);
    }
}

if (!function_exists('getKhmerMonth')) {
    function getKhmerMonth($month): string
    {
        $list = [
            "January" => "មករា",
            "February" => "កុម្ភៈ",
            "March" => "មីនា",
            "April" => "មេសា",
            "May" => "ឧសភា",
            "June" => "មិថុនា",
            "July" => "កក្កដា",
            "August" => "សីហា",
            "September" => "កញ្ញា",
            "October" => "តុលា",
            "November" => "វិច្ឆិកា",
            "December" => "ធ្នូ",
        ];

        return $list[$month];
    }
}

if (!function_exists('getGCSPath')) {
    function getGCSPath($name): string
    {
        return "https://storage.googleapis.com/indo-pacific/" . $name;
    }
}

if (!function_exists('getCurrentRouteName')) {
    function getCurrentRouteName(): string
    {
        return request()->route()->getName();
    }
}

if (!function_exists('callAPI')) {
    function callAPI($method, $url, $data = false)
    {
        $curl = curl_init();
     if ($data)
         $data =  http_build_query($data);
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, true);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}


if (!function_exists('getGMTDate')) {
    function getGMTDate(string $date): string
    {
        $dateTime = new DateTime($date);

        return gmdate('D, d M Y H:i:s T', $dateTime->getTimestamp());
    }
}


if (!function_exists('readableDate')) {
    function readableDate(string $date): string
    {
        return date("F j, Y, g:i a", strtotime($date));
    }
}
