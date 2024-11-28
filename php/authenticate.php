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
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header("Location: ../accountinfo.php");
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
