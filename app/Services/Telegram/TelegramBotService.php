<?php

namespace Vanguard\Services\Telegram;

class TelegramBotService
{
    public function sendMessage($messaggio)
    {
        $chatID = "-774148384";
        $token = "2098769949:AAG2Q7mK6ZCuGu4exySwbmMc_Fw0vujZxrY";
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
