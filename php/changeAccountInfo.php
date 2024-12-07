<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require "functions.php";

    if ( isset($_POST['password'], $_POST['userId']) ) {
        $password = getPasswortByUserId($_POST['userId']);

        if(password_verify($_POST['password'], $password)){
            // change password
            if(isset($_POST['passwordNeu'])){
                if(setNeuesPasswortByUserId($_POST['userId'], $_POST['passwordNeu'])){
                    header("Location: ../accountinfo.php?modifyAccount=TRUE&action=pwchanged");
                } else {
                    echo "Fehler beim ändern des Passwortes.";
                }
            } elseif (isset($_POST['deleteAccount'])) {
                if(deleteAccountByUserId($_POST['userId'])){
                    session_regenerate_id();
                    $_SESSION['loggedin'] = NULL;
                    header(("Location: ../index.php"));
                } else {
                    header("Location: ../accountinfo.php?modifyAccount=TRUE&action=deleteError");
                }
            } else {
                echo "ungültige Formulardaten.";
            }
        } else {
            header("Location: ../accountinfo.php?modifyAccount=TRUE&action=unauthorized");
        }
    } else {
        echo "ungültige Formulardaten.";
    }
?>
