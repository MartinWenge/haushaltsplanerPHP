<?php
    require "databaseConnection.php";

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
        $result = $mysqli->query("select a.id as id, a.name as name, a.bild as bild, a.beschreibung as beschreibung, a.score as score, a.aufwand as aufwand, lh.name as haeufigkeit from aufgaben as a INNER JOIN lookuphaeufigkeit as lh on a.haeufigkeit = lh.id order by rand() limit 50");
        while($row = $result->fetch_assoc()){
            $aufgaben[] = $row;
        }
        return $aufgaben;
    }

    function getAufgabenNachKategorie($kategorie){
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select a.id as id, a.name as name, a.bild as bild, a.beschreibung as beschreibung, a.score as score, a.aufwand as aufwand, lh.name as haeufigkeit from aufgaben as a INNER JOIN lookuphaeufigkeit as lh on a.haeufigkeit = lh.id where a.kategorie = ? limit 50");
        $statement->bind_param("s",$kategorie);

        $statement->execute();
        $result = $statement->get_result();

        $aufgaben = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();
        
        return $aufgaben;
    }

    function getAccountInfo($accountId) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select username,email from accounts where id = ?");
        $statement->bind_param("i", $accountId);

        $statement->execute();
        $result = $statement->get_result();
        $userInfoArray = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        return $userInfoArray[0];
    }

    function getAufgabeById($aufgabenId) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select a.id as id, a.name as name, a.bild as bild, a.beschreibung as beschreibung, a.score as score, a.aufwand as aufwand, lh.name as haeufigkeit from aufgaben as a INNER JOIN lookuphaeufigkeit as lh on a.haeufigkeit = lh.id where a.id = ? limit 50");
        $statement->bind_param("i",$aufgabenId);

        $statement->execute();
        $result = $statement->get_result();
        $aufgabenArray = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        return $aufgabenArray[0];
    }

    function addPlaneNeueAufgabeEin($idAufgabe, $idUser, $datum) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("insert into tasks (userId, aufgabenId, date, isDone) values (?,?,?,0)");
        $statement->bind_param("iis",$idUser,$idAufgabe,$datum);

        $statement->execute();
        $statement->close();

        return TRUE;
    }

    function getHaeufigkeitInTagenByAufgabe($idAufgabe) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("select lh.days as tage from lookuphaeufigkeit as lh INNER JOIN aufgaben as a ON a.haeufigkeit = lh.id WHERE a.id = ? LIMIT 1");
        $statement->bind_param("i",$idAufgabe);

        $statement->execute();
        $statement->store_result();
        $statement->bind_result($tage);
        $statement->fetch();

        return $tage;
    }
?>
