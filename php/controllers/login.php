<?php

    include('../models/user.php');
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $user = new User();
        $user->selectByUsername($username);

        if($user->getId() == "")
        {
            echo "NOUSER";
            exit();
        }
        elseif($user->getPassword() !=  $password)
        {
            echo "CREDERR";
            exit();
        }
        elseif($user->getPassword() == $password)
        {
            if(session_start())
            {
                $_SESSION['id'] = $user->getId();
                $_SESSION['mobile'] = $user->getMobile();
                $_SESSION['type'] = $user->getUserType();
                $_SESSION['hash'] = $user->getPassword();
                $_SESSION['name'] = $user->getName();
                if($user->getUserType() == 1)
                {
                    echo 'ADMIN';
                }
                elseif($user->getUserType() == 2)
                {
                    echo 'TEACHER';
                }
                elseif($user->getUserType() == 3)
                {
                    echo 'STUDENT';
                }
                else
                {
                    echo 'TYPEERR';
                    exit();
                }
            }
            else
            {
                echo "SESSERR";
                exit();
            }          
        }
    }
    
    //POSTERR -> POST REQUEST FAILED.
    //NOUSER  -> NO VALID USER.
    //CREDERR -> CREDENTIAL NOT MATCH.
    //ADMIN   -> ADMIN LOGIN SUCCESS.
    //TEACHER -> TEACHER LOGIN SUCCESS.
    //STUDENT -> STUDENT LOGIN SUCCESS.
    //TYPEERR -> USER TYPE ERROR.
    //SESSERR -> SESSION CREATION ERROR.