<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require "functions.php";

    if ( !isset($_POST['username'], $_POST['password']) ) {
        exit('Please fill both the username and password fields!');
    }

    $accountData = getPasswortByUsername($_POST['username']);

    if ($accountData['userId'] != NULL) {
        if (password_verify($_POST['password'], $accountData['passwort'])) {
            session_regenerate_id();
            // don' set login flag here, go for 2FA
            $_SESSION['loggedin'] = NULL;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['userId'] = $accountData['userId'];

            // go to 2FA page
            header("Location: ../2fapage.php");
        } else {
            session_regenerate_id();
            $_SESSION['loggedin'] = NULL;
            header("Location: ../login.php?unauthorized=TRUE");
        }
    } else {
        header("Location: ../login.php?unauthorized=TRUE");
    }
?>
