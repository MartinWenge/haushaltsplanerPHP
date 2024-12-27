<?php
    require "functions.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../login.php');
        exit;
    }

    if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];
    }

    if ( $_SERVER["REQUEST_METHOD"] !== "POST"){
        header("Location: ../neueAufgabeAnlegen.php?directCall=TRUE");
        exit();
    }

    if ( !isset($_POST['name'], $_POST['kategorie'], $_POST['beschreibung'], $_POST['aufwand'], $_POST['score'], $_POST['haeufigkeit'], $_FILES['bild']) ) {
        header("Location: ../neueAufgabeAnlegen.php?incompleteForm=TRUE");
        exit();
    }

    //process figure upload
    if(! $_FILES["bild"]["error"] == UPLOAD_ERR_OK ){
        header("Location: ../neueAufgabeAnlegen.php?imageError=TRUE");
        exit();
    }

    if( $_FILES["bild"]["size"] > 524288 ){
        header("Location: ../neueAufgabeAnlegen.php?imageError=TRUE");
        exit();
    }

    $allowedMimetypes = ["image/png", "image/jpeg"];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($_FILES["bild"]["tmp_name"]);

    if(! in_array($mimeType, $allowedMimetypes)){
        header("Location: ../neueAufgabeAnlegen.php?imageError=TRUE");
        exit();
    }

    $pathinfo = pathinfo($_FILES["bild"]["name"]);
    $databaseFilename = "figures/upload_" . $_POST['kategorie'] . "_" . rand(0,999) . "." . $pathinfo["extension"];
    $destination = __DIR__ . "/../" . $databaseFilename;

    if( ! move_uploaded_file($_FILES["bild"]["tmp_name"], $destination) ){
        header("Location: ../neueAufgabeAnlegen.php?imageError=TRUE");
        exit();
    }

    // write neue Aufgabe to database (filepath to be stored as string) newid should not be zero ;-)
    $newId = createNeueAufgabe($_POST['name'], $_POST['haeufigkeit'], $_POST['beschreibung'], $_POST['score'], $_POST['aufwand'], $databaseFilename, $_POST['kategorie']);
    if($newId == FALSE) {
        header("Location: ../neueAufgabeAnlegen.php?databaseError=TRUE");
        exit();
    }
    
    header("Location: ../aufgabeEinplanen.php?userId=" . $userId . "&aufgabeId=" . $newId);
?>
