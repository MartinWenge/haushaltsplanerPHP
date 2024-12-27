<?php
    require "functions.php";

    if ( !isset($_POST['startdatum'],$_POST['ansicht']) ) {
        exit('kein Datum angegeben!');
    }
    
    if($_POST['ansicht']){
        $ansicht="wochenplan=TRUE";
    }else{
        $ansicht="monatsplan=TRUE";
    }
    
    header("Location: ../deinHaushaltsplan.php?startdatum=" . $_POST['startdatum'] . "&" . $ansicht);
?>
