<?php
    require "functions.php";

    if ( !isset($_POST['taskId']) ) {
        exit('keine task id mitgesendet!');
    }

    if ( !isset($_POST['startdatum'],$_POST['ansicht']) ) {
        exit('kein Ansichtsmodus oder Datum angegeben!');
    }

    erledigeTaskById($_POST['taskId']);
    
    if($_POST['ansicht']){
        $ansicht="wochenplan=TRUE";
    }else{
        $ansicht="monatsplan=TRUE";
    }
    
    header("Location: ../deinHaushaltsplan.php?startdatum=" . $_POST['startdatum'] . "&" . $ansicht);
?>
