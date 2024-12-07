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

        $statement = $mysqli->prepare("SELECT id AS userId, username, email, birthday FROM accounts WHERE id = ?");
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

        $statement = $mysqli->prepare("INSERT INTO tasks (userId, aufgabenId, date, isDone) VALUES (?,?,?,0)");
        $statement->bind_param("iis",$idUser,$idAufgabe,$datum);

        $statement->execute();
        $statement->close();

        return TRUE;
    }

    function getHaeufigkeitInTagenByAufgabe($idAufgabe) {
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("SELECT lh.days AS tage FROM lookuphaeufigkeit AS lh INNER JOIN aufgaben AS a ON a.haeufigkeit = lh.id WHERE a.id = ? LIMIT 1");
        $statement->bind_param("i",$idAufgabe);

        $statement->execute();
        $statement->store_result();
        $statement->bind_result($tage);
        $statement->fetch();
        $statement->close();

        return $tage;
    }

    function getTaskById($taskId) {
        $mysqli = dbConnect();
        
        if($statement = $mysqli->prepare("SELECT t.id AS id, t.date AS datum, a.name AS name, a.score AS score, a.aufwand AS aufwand FROM tasks AS t INNER JOIN aufgaben AS a ON a.id = t.aufgabenId WHERE t.id = ? LIMIT 1")) {
            $statement->bind_param("i", $taskId);
            $statement->execute();
            $result = $statement->get_result();
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            $statement->close();
        }

        return $tasks[0];
    }

    function erledigeTaskById($taskId) {
        $mysqli = dbConnect();

        if($statement = $mysqli->prepare("UPDATE tasks SET isDone = 1 WHERE id = ?")){
            $statement->bind_param("i", $taskId);
            $statement->execute();
            $statement->close();
        } else {
            return FALSE;
        }

        return TRUE;
    }

    function aendereTaskDatumById($taskId, $neuesDatum) {
        $mysqli = dbConnect();

        if($statement = $mysqli->prepare("UPDATE tasks SET date = ? WHERE id = ?")){
            $statement->bind_param("si", $neuesDatum, $taskId);
            $statement->execute();
            $statement->close();
        } else {
            return FALSE;
        }

        return TRUE;
    }

    function formatiereDatum($datum) {
        $datumFormatiert = substr($datum,-2,2) . "." . substr($datum,5,2) . "." . substr($datum,0,4);
        return $datumFormatiert;
    }

    function formatiereDatumUndTag($datum) {
        $date = new DateTime($datum, new DateTimeZone('Europe/Berlin'));
        return $date->format('l') . ",<br>" . formatiereDatum($datum);
    }

    function datumEineWocheEher($datum) {
        $date = new DateTime($datum, new DateTimeZone('Europe/Berlin'));
        $date->modify('-7 days');
        return $date->format("Y-m-d");
    }

    function datumEineWocheSpaeter($datum) {
        $date = new DateTime($datum, new DateTimeZone('Europe/Berlin'));
        $date->modify('+7 days');
        return $date->format("Y-m-d");
    }

    function getWochenaufgaben($startdatum,$userId){
        $datum = new DateTime($startdatum, new DateTimeZone('Europe/Berlin'));

        for($i = 0; $i < 7; $i++){
            $aufgaben = getActiveTasksByDatumUndUser($datum->format("Y-m-d"), $userId);
            $day = array('datum' => $datum->format("Y-m-d"), 'aufgaben' => $aufgaben);

            $datum->modify('+1 day');
            $wochenaufgaben[] = $day;
        }
        return $wochenaufgaben;
    }

    function getActiveTasksByDatumUndUser($datum, $userId){
        $mysqli = dbConnect();

        $statement = $mysqli->prepare("SELECT t.id, a.name FROM tasks AS t INNER JOIN aufgaben AS a ON t.aufgabenId = a.id WHERE t.isDone = 0 AND t.userId = ? AND t.date = ?");
        $statement->bind_param("is", $userId, $datum);

        $statement->execute();
        $result = $statement->get_result();
        $aufgaben = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();

        return $aufgaben;
    }
?>
