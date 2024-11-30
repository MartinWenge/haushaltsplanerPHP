<?php
    require "functions.php";

    if ( !isset($_POST['taskId']) ) {
        exit('keine task id mitgesendet!');
    }

    echo "task id = " . $_POST['taskId'];

    erledigeTaskById($_POST['taskId']);

    header("Location: ../deinHaushaltsplan.php?sortierung=alle");

?>
