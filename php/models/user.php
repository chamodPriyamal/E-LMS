<?php

    class User 
    {
        private $id;
        private $name;
        private $mobile;
        private $password;
        private $profile_picture;
        private $user_type;
        private $default_pic;
        
        function __construct()
        {
            
        }
        function setValues($name , $mobile , $password , $profile_picture , $user_type)
        {
            $this->name = $name;
            $this->mobile = $mobile;
            $this->password = $password;
            $this->profile_picture = $profile_picture;
            $this->user_type = $user_type;
        }

        function insert()
        {
            include 'database.php';
            $cmd = $conn->prepare("INSERT INTO `users` (`name`, `mobile`, `password`, `profile_picture`, `type`) VALUES (?,?,?,?,?)");            
            $cmd->bind_param("ssssi",$this->name,$this->mobile,$this->password,$this->profile_picture,$this->user_type);
            if($cmd->execute() && $cmd->affected_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function delete($id)
        {       
            include 'database.php';
            $cmd = $conn->prepare("DELETE FROM `users` WHERE id = ?");
            $cmd->bind_param("i",$id);
            if($cmd->execute() && $cmd->affected_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function update()
        {
            include 'database.php';
            $cmd = $conn->prepare("UPDATE `users` SET `name`= ? ,`mobile`= ? ,`password`= ? ,`profile_picture`= ? ,`type` =  ? WHERE id = ?");
            $cmd->bind_param("sssssi",$this->name,$this->mobile,$this->password,$this->profile_picture,$this->user_type,$this->id);
            if($cmd->execute() && $cmd->affected_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function select($id)
        {
            include 'database.php';
            $cmd = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $cmd->bind_param("i",$id);
            $cmd->execute();
            $result = $cmd->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->mobile = $row['mobile'];
                $this->password = $row['password'];
                $this->profile_picture = $row['profile_picture'];
                $this->user_type = $row['type'];
                return true;
            }
            else
            {
                return false;
            }
        }
        function selectByUsername($username)
        {
            include 'database.php';
            $cmd = $conn->prepare("SELECT * FROM users WHERE mobile = ?");
            $cmd->bind_param("i",$username);
            $cmd->execute();
            $result = $cmd->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->mobile = $row['mobile'];
                $this->password = $row['password'];
                $this->profile_picture = $row['profile_picture'];
                $this->user_type = $row['type'];
                return true;
            }
            else
            {
                return false;
            }
        }
        function selectAll()
        {
            include 'database.php';
            $cmd = $conn->prepare("SELECT * FROM users");
            $cmd->execute();
            $result = $cmd->get_result();
            $output = array();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    array_push($output , $row);
                }
                return $output;
            }
            else
            {
                return false;
            }
        }
        function setName($name)
        {
            $this->name = $name;
        }
        function setMobile($mobile)
        {
            $this->mobile = $mobile;
        }
        function setPassword($password)
        {
            $this->password = $password;
        }
        function setProfilePicture($profile_picture)
        {
            $this->profile_picture = $profile_picture;
        }
        function setUserType($user_type)
        {
            $this->user_type = $user_type;
        }
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function getMobile()
        {
            return $this->mobile;
        }
        function getPassword()
        {
            return $this->password;
        }
        function getProfilePicture()
        {
            return $this->profile_picture;
        }
        function getUserType()
        {
            return $this->user_type;
        }
        function free()
        {
            __destruct();
        }
        function __destruct(){}
    }
?>