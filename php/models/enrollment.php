<?php

    class Enrollment
    {
        private $id;
        private $uid;
        private $class_id;

        function __construct(){}

        function setValues($uid , $class_id)
        {
            $this->uid = $uid;
            $this->class_id = $class_id;
        }
        function getId()
        {
            return $this->id;
        }
        function getUid()
        {
            return $this->uid;
        }
        function getClassId()
        {
            return $this->class_id;
        }
        function setUid($uid)
        {
            $this->uid = $uid;
        }
        function setClassId($class_id)
        {
            $this->class_id = $class_id;
        }
        function insert()
        {
            include 'database.php';
            $cmd = $conn->prepare("INSERT INTO `enrollment` (`uid`, `class`) VALUES (?,?)");            
            $cmd->bind_param("ii",$this->uid,$this->class_id);
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
            $cmd = $conn->prepare("DELETE FROM `enrollment` WHERE id = ?");
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
            $cmd = $conn->prepare("UPDATE `enrollment` SET `uid`= ? ,`class`= ? WHERE id = ?");
            $cmd->bind_param("iii",$this->uid,$this->class_id,$this->id);
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
            $cmd = $conn->prepare("SELECT * FROM enrollment WHERE uid = ?");
            $cmd->bind_param("i",$id);
            $cmd->execute();
            $result = $cmd->get_result();
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
        function free()
        {
            __destruct();
        }
        function __destruct(){}
    }

?>