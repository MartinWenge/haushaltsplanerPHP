<?php 
    require "functions.php";

    // change password
    if ( isset($_POST['passwordAlt'], $_POST['passwordNeu'], $_POST['userId']) ) {
        $mysqli = dbConnect();
        
        if($statement = $mysqli->prepare('SELECT password FROM accounts WHERE id = ?')) {
            $statement->bind_param('i', $_POST['userId']);
            $statement->execute();
            $statement->store_result();
            $statement->bind_result($password);
            $statement->fetch();

            if (password_verify($_POST['passwordAlt'], $password)) {
                if($statement = $mysqli->prepare('UPDATE accounts SET password = ? WHERE id = ?')) {
                    $passwordNew = password_hash($_POST['passwordNeu'], PASSWORD_DEFAULT);
                    $statement->bind_param('si', $passwordNew, $_POST['userId']);
                    $statement->execute();

                    header("Location: ../accountinfo.php?modifyAccount=TRUE&action=pwchanged");

                }else {
                    echo 'Could not prepare statement';
                }
            } else {
                header("Location: ../accountinfo.php?modifyAccount=TRUE&action=unauthorized");
            }

        } else {
            echo 'Could not prepare statement';
        }

        $statement->close();
        $mysqli->close();
    }

    elseif ( isset($_POST['userId'], $_POST['deleteAccount'])) {
        # code...
    }

    elseif ( isset($_POST['userId'], $_POST['resetAccount'])) {
        # code...
    }

    else {
        echo "invalid form data";
    }

?>