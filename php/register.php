<?php
    require "databaseConnection.php";

    if (!isset($_POST['usernameNew'], $_POST['passwordNew'], $_POST['emailNew'])) {
        exit('Please complete the registration form!');
    }

    if (empty($_POST['usernameNew']) || empty($_POST['passwordNew']) || empty($_POST['emailNew'])) {
        exit('Please complete the registration form');
    }

    $mysqli = dbConnect();

    if ($statement = $mysqli->prepare('SELECT id,password FROM accounts WHERE username = ?')) {
        $statement->bind_param('s', $_POST['usernameNew']);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            echo 'Username exists, please choose another!';
        } else {
            if ($statement = $mysqli->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                $password = password_hash($_POST['passwordNew'], PASSWORD_DEFAULT);
                $statement->bind_param('sss', $_POST['usernameNew'], $password, $_POST['emailNew']);
                $statement->execute();

                header("Location: ../login.php?newAccount=" . $_POST['usernameNew']);
            } else {
                echo 'Could not prepare statement!';
            }
        }
        $statement->close();
    } else {
        echo 'Could not prepare statement!';
    }

    $mysqli->close();
?>