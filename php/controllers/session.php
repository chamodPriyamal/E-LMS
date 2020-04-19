<?php

    include('../php/models/user.php');
    if(session_start())
    {
        $username = $_SESSION['mobile'];
        $password = $_SESSION['hash'];
        
        $user = new User();
        $user->selectByUsername($username);

           
        if($user->getPassword() == $password && $_SESSION['type'] == $user->getUserType() && $_SESSION['id'] == $user->getId())
        {

        }
        else
        {
            session_unset();
            session_destroy();
            header("Location: " . SITEURL);
        }
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location: " . SITEURL);
    }

 