<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require "databaseConnection.php";

    $mysqli = dbConnect();

    if ( !isset($_POST['username'], $_POST['password']) ) {
        exit('Please fill both the username and password fields!');
    }

    $statement = $mysqli->prepare('SELECT id, password FROM accounts WHERE username = ?');
    $statement->bind_param('s', $_POST['username']);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        $statement->bind_result($id, $password);
        $statement->fetch();

        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            // don' set login flag here, go for 2FA
            $_SESSION['loggedin'] = NULL;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['userId'] = $id;

            // go to 2FA page
            header("Location: ../2fapage.php");
        } else {
            session_regenerate_id();
            $_SESSION['loggedin'] = NULL;
            echo 'Incorrect username and/or password!';
        }
    } else {
        echo 'Incorrect username and/or password!';
    }

    $statement->close();
?>
