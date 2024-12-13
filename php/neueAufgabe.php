<?php
    require "functions.php";

    if ( !isset($_POST['name'], $_POST['kategorie'], $_POST['beschreibung'], $_POST['aufwand'], $_POST['score'], $_POST['haeufigkeit'], $_POST['bild']) ) {
        exit('Please fill all fields!');
    }

    echo "neue Aufgabe anlegen: " . $_POST['name'] . ", Kategorie: " . $_POST['kategorie'] . ", Beschreibung: " . $_POST['beschreibung'] . ", Aufwand: " . $_POST['aufwand'] . ", Punkte: " . $_POST['score'] . ", Häufigkeit: " . $_POST['haeufigkeit']. ", Bild: " . $_POST['bild'];
?>