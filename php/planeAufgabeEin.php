<?php
    require "functions.php";

    if ( !isset($_POST['aufgabenId'], $_POST['userId'], $_POST['startdatum'], $_POST['repeat']) ) {
        exit('Please fill all fields!');
    }
    $aufgabenId = $_POST['aufgabenId'];
    $userId = $_POST['userId'];
    $datum = $_POST['startdatum'];

    $tageZwischenWiederholungen = getHaeufigkeitInTagenByAufgabe($aufgabenId);

    for ($i =0; $i < $_POST['repeat']; $i++){
        addPlaneNeueAufgabeEin($aufgabenId,$userId,$datum);
        
        $date = new DateTime($datum, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $tageZwischenWiederholungen . ' days');
        $datum = $date->format('Y-m-d');
    }

    header("Location: ../deinHaushaltsplan.php");

?>
