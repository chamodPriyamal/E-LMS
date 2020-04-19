<?php 

    class Sms
    {
        private $to;
        private $text;
    
        function __construct($to , $text)
        {
            $this->to = $to;
            $this->text = urlencode($text);
        }

        function send()
        {
            $url = SMS_URL . "?id=" . SMS_USERNAME . "&pw=" . SMS_PASSWORD . "&to=" . $this->to . "&text=" . $this->text;
            $ret = file($url);
            $res= explode(":",$ret[0]);
            if (trim($res[0])=="OK")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }