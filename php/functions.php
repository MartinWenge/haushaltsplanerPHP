<?php
    require "config.php";

    function dbConnect(){
        $mysqli = new mysqli(SERVER, USERNAME, PASSWORD,DATABASE);
        if($mysqli->connect_errno != 0){
            return FALSE;
        } else {
            return $mysqli;
        }
    }

    function getKathegorien(){
        $mysqli = dbConnect();
        $result = $mysqli->query("select distinct kathegorie from aufgaben");
        while($row = $result->fetch_assoc()){
            $kathegorien[] = $row;
        }
        return $kathegorien;
    }

    function getAlleAufgaben(){
        $mysqli = dbConnect();
        $result = $mysqli->query("select * from aufgaben order by rand() limit 50");
        while($row = $result->fetch_assoc()){
            $aufgaben[] = $row;
        }
        return $aufgaben;
    }

?>
