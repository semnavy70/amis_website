<?php

namespace Vanguard\Services\Parser;

class BodyParser
{
    /** @var  string */
    private $html;
    /** @var  string */
    private $text;
    private $parseRules = [
        '/\s+/' => ' ', //Remove HTML's whitespaces
        '/<(img)\b[^>]*src=\"([^>"]+)\"[^>]*>/Uis' => '____$2____', // Remove image tags without alt
        '/<(iframe)\b[^>]*src=\"([^>"]+)\"[^>]*>(.*)<\/iframe>/Uis' => '____$2____', // Remove image tags without alt
        '/<a(.*)href=[\'"](.*)[\'"]>(.*)<\/a>/Uis' => '$3---$2---', //Parse links
        '/<hr(.*)>/Uis' => "____", //Parse lines
        '/<br(.*)>/Uis' => "____", //Parse breaklines
        '/<(.*)br>/Uis' => "____", //Parse broken breaklines
        '/<p(.*)>(.*)<\/p>/Uis' => '____$2', //Parse alineas
        //Lists
        '/(<ul\b[^>]*>|<\/ul>)/i' => "\n\n",
        '/(<ol\b[^>]*>|<\/ol>)/i' => "\n\n",
        '/(<dl\b[^>]*>|<\/dl>)/i' => "\n\n",
        '/<li\b[^>]*>(.*?)<\/li>/i' => "____$1",
        '/<dd\b[^>]*>(.*?)<\/dd>/i' => "____$1",
        '/<dt\b[^>]*>(.*?)<\/dt>/i' => "____$1",
        '/<li\b[^>]*>/i' => "\n\t* ",
        //Parse table columns
        '/<tr>(.*)<\/tr>/Uis' => "____$1",
        '/<td>(.*)<\/td>/Uis' => "____$1",
        '/<th>(.*)<\/th>/Uis' => "____$1",
        //Parse markedup text
        '/<em\b[^>]*>(.*?)<\/em>/i' => "$2",
        '/<b>(.*)<\/b>/Uis' => '$1',
        '/<strong(.*)>(.*)<\/strong>/Uis' => '$2',
        '/<i>(.*)<\/i>/Uis' => '$1',
        '/<u>(.*)<\/u>/Uis' => '$1',
        //Headers
        '/<h1(.*)>(.*)<\/h1>/Uis' => "____$2",
        '/<h2(.*)>(.*)<\/h2>/Uis' => "____$2",
        '/<h3(.*)>(.*)<\/h3>/Uis' => "____$2",
        '/<h4(.*)>(.*)<\/h4>/Uis' => "____$2",
        '/<h5(.*)>(.*)<\/h5>/Uis' => "____$2",
        '/<h6(.*)>(.*)<\/h6>/Uis' => "____$2",
        //Surround tables with newlines
        '/<table(.*)>(.*)<\/table>/Uis' => "____$2",
    ];

    /**
     * @param $rule
     * @param $value
     */
    public function setParseRule($rule, $value)
    {
        $this->parseRules[$rule] = $value;
    }

    /**
     * @param $rule
     */
    public function removeParseRule($rule)
    {
        if (array_key_exists($rule, $this->parseRules)) {
            unset($this->parseRules[$rule]);
        }
    }

    /**
     * @param $string
     * @return string
     */
    public function parseString($string)
    {
        $this->setHtml($string);
        $this->parse();
        return $this->clearn(explode("____", $this->getText()));
    }

    /**
     * @param $string
     * @return $this
     */
    private function setHtml($string)
    {
        $this->html = $string;
        return $this;
    }

    /**
     * Parse the HTML and put it into the text variable
     */
    private function parse()
    {
        $string = $this->getHtml();
        foreach ($this->parseRules as $rule => $output) {
            $string = preg_replace($rule, $output, $string);
        }
        $string = html_entity_decode($string);
        //Strip remaining tags
        $string = strip_tags($string);
        //Fix double whitespaces
        $string = preg_replace('/(  *)/', ' ', $string);
        //Newlines with a space behind it - don't need that. (except in some cases, in which you'll miss 1 whitespace.
        // Well, too bad for you. File a PR <3
        $string = preg_replace('/\n /', "\n", $string);
        $string = preg_replace('/ \n/', "\n", $string);
        //Remove tabs before newlines
        $string = preg_replace('/\t /', "\t", $string);
        $string = preg_replace('/\t \n/', "\n", $string);
        $string = preg_replace('/\t\n/', "\n", $string);
        //Replace all \n with \r\n because some clients prefer that
        $string = preg_replace('/\n/', "\r\n", $string);
        $this->setText($string);
    }

    /**
     * @return string
     */
    private function getHtml()
    {
        return $this->html;
    }

    /**
     * @param $string
     * @return $this
     */
    private function setText($string)
    {
        $this->text = $string;
        return $this;
    }

    public function clearn($arr)
    {
        $result = array();
        foreach ($arr as $item) {
            if (trim($item) != "") {
                $e = array("type" => "text", "value" => $item, "value2" => "");
                if ((strpos($item, '.png') !== false) || (strpos($item, '.jpg') !== false) || (strpos($item, '.gif') !== false) || (strpos($item, '.PNG') !== false) || (strpos($item, '.JPG') !== false) || (strpos($item, '.GIF') !== false) || (strpos($item, '.jpeg') !== false) || (strpos($item, '.JPEG') !== false)) {
                    $e = array("type" => "img", "value" => $item, "value2" => "");
                }
                if (strpos($item, '---') !== false) {
                    $arr = explode('---', $item);
                    $e = array("type" => "link", "value" => $arr[0], "value2" => $arr[1]);
                }
                if ((strpos($item, 'https://www.youtube.com/embed/') !== false)) {
                    $video_id = explode("?", explode("https://www.youtube.com/embed/", $item)[1])[0];
                    //$e = $video_id;
                    $e = array("type" => "youtube", "value" => $video_id, "value2" => "");
                }
                $result[] = $e;
            }
        }
        return $result;
    }

    /**
     * @return string
     */
    private function getText()
    {
        return $this->text;
    }

}
