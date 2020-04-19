<?php

    class Course
    {
        private $id;
        private $subject;
        private $grade;
        private $institute;
        private $description;
        private $enroll_key;
        private $enroll_key_visibility;
        private $owner;
        private $picture;


        function __construct(){

        }
     
        function setValues($subject , $grade , $institute , $description , $enroll_key, $enroll_key_visibility , $owner , $picture)
        {
            $this->subject = $subject;
            $this->grade = $grade;
            $this->institute = $institute;
            $this->description = $description;
            $this->enroll_key = $enroll_key;
            $this->enroll_key_visibility = $enroll_key_visibility;
            $this->owner = $owner;
            $this->picture = $picture;
        }

        function getSubject()
        {
            return $this->subject;
        }
        function getGrade()
        {
            return $this->grade;
        }
        function getInstitute()
        {
            return $this->institute;
        }
        function getDescription()
        {
            return $this->description;
        }
        function getEnrollKey()
        {
            return $this->enroll_key;
        }
        function getEnrollKeyVisibility()
        {   
            return $this->enroll_key_visibility;
        }
        function getOwner()
        {
            return $this->owner;
        }
        function getPicture()
        {
            return $this->picture;
        }
        function setSubject($subject)
        {
            $this->subject = $subject;
        }
        function setGrade($grade)
        {
            $this->grade = $grade;
        }
        function setInstitute($institute)
        {
            $this->institute = $institute;
        }
        function setDescription($description)
        {
            $this->description = $description;
        }
        function setEnrollKey($enrollKey)
        {
            $this->enrollKey = $enrollKey;
        }
        function setEnrollKeyVisibility($enrollKeyVisibility)
        {
            $this->enrollKeyVisibility = $enrollKeyVisibility;
        }   
        function setOwner($owner)
        {
            $this->owner = $owner;
        }
        function setPicture($picture)
        {
            $this->picture = $picture;
        }
        function insert()
        {
            include 'database.php';
            $cmd = $conn->prepare("INSERT INTO `class` (`subject`, `grade`, `institute`, `description`, `enroll_key`, `visible_enroll_key`, `owner`, `picture`) VALUES (?,?,?,?,?,?,?,?)");            
            $cmd->bind_param("iiissiis",$this->subject,$this->grade,$this->institute,$this->description,$this->enroll_key,$this->enroll_key_visibility,$this->owner,$this->picture);
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
            $cmd = $conn->prepare("DELETE FROM `class` WHERE id = ?");
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
            $cmd = $conn->prepare("UPDATE `class` SET `subject` = ? , `grade` = ? , `institute` = ? , `description` = ?, `enroll_key` = ? , `visible_enroll_key` = ? , `owner` = ? , `picture` = ? WHERE id = ?");
            $cmd->bind_param("iiissiis",$this->subject,$this->grade,$this->institute,$this->description,$this->enroll_key,$this->enroll_key_visibility,$this->owner,$this->picture,$this->id);
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
            $cmd = $conn->prepare("SELECT * FROM class WHERE id = ?");
            $cmd->bind_param("i",$id);
            $cmd->execute();
            $result = $cmd->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->subject = $row['subject'];
                $this->grade = $row['grade'];
                $this->institute = $row['institute'];
                $this->description = $row['description'];
                $this->enroll_key = $row['enroll_key'];
                $this->enroll_key_visibility = $row['visible_enroll_key'];
                $this->owner = $row['owner'];
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
            $cmd = $conn->prepare("SELECT * FROM class");
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
        function free()
        {
            __destruct();
        }
        function __destruct(){}
    }

?>