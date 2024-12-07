<?php
    require "functions.php";

    if ( !isset($_POST['taskIdChange'], $_POST['neuesDatum']) ) {
        exit('es fehlen informationen!');
    }

    echo "task id = " . $_POST['taskIdChange'] . ", neues Datum = " . $_POST['neuesDatum'];

    aendereTaskDatumById($_POST['taskIdChange'], $_POST['neuesDatum']);

    header("Location: ../deinHaushaltsplan.php?sortierung=alle");

?>
