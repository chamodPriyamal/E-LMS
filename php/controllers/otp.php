<?php

    include '../models/config.php';
    require '../models/sms.php';

    if(session_start() && isset($_POST['to']))
    {
        $to = $_POST['to'];
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $otp = '';
        for ($i = 0; $i < 4; $i++) 
        {
            $otp .= $characters[rand(0, $charactersLength - 1)];
        }
        $md5_otp = md5($otp);
        $_SESSION['hash'] = $md5_otp;

        $otp = new Sms($to,"Your E-LMS Platform Verification Code : " . $otp);
        $otp->send();
    }
    else
    {
        echo "ERROR";
        exit();
    }
    