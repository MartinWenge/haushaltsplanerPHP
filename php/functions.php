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

    function getKategorien(){
        $mysqli = dbConnect();
        $result = $mysqli->query("select distinct kategorie from aufgaben");
        while($row = $result->fetch_assoc()){
            $kategorien[] = $row;
        }
        return $kategorien;
    }

    function getAlleAufgaben(){
        $mysqli = dbConnect();
        $result = $mysqli->query("select * from aufgaben order by rand() limit 50");
        while($row = $result->fetch_assoc()){
            $aufgaben[] = $row;
        }
        return $aufgaben;
    }

    function getAufgabenNachKategorie($kategorie){
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select * from aufgaben where kategorie = ?");
        $statement->bind_param("s",$kategorie);

        $statement->execute();
        $result = $statement->get_result();

        $aufgaben = $result->fetch_all(MYSQLI_ASSOC);
        
        return $aufgaben;
    }

    function getAccountInfo($accountId) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select username,email from accounts where id = ?");
        $statement->bind_param("i", $accountId);

        $statement->execute();
        $result = $statement->get_result();
        $userInfoArray = $result->fetch_all(MYSQLI_ASSOC);

        return $userInfoArray[0];
    }
?>
