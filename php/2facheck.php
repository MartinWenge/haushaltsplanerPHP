<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require "functions.php";

    if ( !isset($_POST['answer'], $_POST['userId']) ) {
        echo "Bitte gib eine Antwort ein!";
    }

    $mysqli = dbConnect();
    if($statement = $mysqli->prepare("SELECT birthday FROM accounts WHERE id = ?")){
        $statement-> bind_param("i", $_POST['userId']);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($birthday);
        $statement->fetch();

        $verification = FALSE;
        $antwort = $_POST['answer'];
        if (isset($_POST['geburtstagsjahr'])){
            $jahr = substr($birthday,0,4);
            if($jahr == $antwort){
                $verification = TRUE;
            }
        } elseif (isset($_POST['geburtstagsmonat'])){
            $monat = substr($birthday,5,2);
            if( (!strlen($antwort) == 2) && (substr($antwort,0,1) != "0")){
                $antwort = "0" . $antwort;
            }
            if($monat == $antwort) {
                $verification = TRUE;
            }
        } elseif (isset($_POST['geburtstagstag'])){
            $tag = substr($birthday,8,2);
            if( (!strlen($antwort) == 2) && (substr($antwort,0,1) != "0")){
                $antwort = "0" . $antwort;
            }
            if($tag == $antwort) {
                $verification = TRUE;
            }
        } else {
            echo "ungültiges Prüfkriterium!";
        }

        if($verification == TRUE) {
            $_SESSION['loggedin'] = TRUE;
            header("Location: ../accountinfo.php");
        } else {
            header("Location: ../2fapage.php?action=unauthorized");
        }
    }
?>
