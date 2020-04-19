<?php

    class Subject
    {
        private $id;
        private $name;
        private $picture;

        function __construct() 
        {
        
        }
        function setValues($id , $name , $picture)
        {
            $this->id = $id;
            $this->name = $name;
            $this->picture = $picture;
        }
        function insert()
        {
            include 'database.php';
            $cmd = $conn->prepare("INSERT INTO `subject` (`name`, `picture`)VALUES (?,?)");            
            $cmd->bind_param("ss",$this->name,$this->picture);
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
            $cmd = $conn->prepare("DELETE FROM `subject` WHERE id = ?");
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
            $cmd = $conn->prepare("UPDATE `subject` SET `name`= ? , `picture`= ? WHERE id = ?");
            $cmd->bind_param("ssi",$this->name,$this->picture,$this->id);
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
            $cmd = $conn->prepare("SELECT * FROM subject WHERE id = ?");
            $cmd->bind_param("i",$id);
            $cmd->execute();
            $result = $cmd->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->picture = $row['picture'];
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
            $cmd = $conn->prepare("SELECT * FROM subject");
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
        function setPicture($picture)
        {
            $this->picture = $picture;
        }
        function getName()
        {
            return $this->name;
        }
        function getPicture()
        {
            return $this->picture;
        }
        function getId()
        {
            return $this->id;
        }
        function free()
        {
            __destruct();
        }
        function __destruct(){}
    }
?>