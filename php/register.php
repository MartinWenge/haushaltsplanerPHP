<?php
    require "functions.php";

    if (!isset($_POST['usernameNew'], $_POST['passwordNew'], $_POST['emailNew'], $_POST['birthdayNew'])) {
        exit('Please complete the registration form!');
    }

    if (empty($_POST['usernameNew']) || empty($_POST['passwordNew']) || empty($_POST['emailNew']) || empty($_POST['birthdayNew'])) {
        exit('Please complete the registration form');
    }

    $today = new DateTime();
    $geburtstag = new DateTime($_POST['birthdayNew']);
    if($today < $geburtstag) {
        header("Location: ../login.php?notBorn=TRUE");
    } else {
        $accountData = getPasswortByUsername($_POST['usernameNew']);

        if($accountData['userId'] == NULL) {
            if(createNeuenAccount($_POST['usernameNew'], $_POST['passwordNew'], $_POST['emailNew'], $_POST['birthdayNew'])) {
                header("Location: ../login.php?newAccount=" . $_POST['usernameNew']);
            } else {
                echo "Fehler beim erstellen des neuen Nutzers, probiere es noch einmal.";
            }
        } else {
            header("Location: ../login.php?existingUsername=" . $_POST['usernameNew']);
        }
    }
?>
