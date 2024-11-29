<?php
    require "databaseConnection.php";

    if ( !isset($_POST['aufgabenId'], $_POST['userId'], $_POST['startdatum'], $_POST['repeat']) ) {
        exit('Please fill all fields!');
    }

    echo $_POST['aufgabenId'], $_POST['userId'], $_POST['startdatum'], $_POST['repeat'];

    // $mysqli = dbConnect();

?>