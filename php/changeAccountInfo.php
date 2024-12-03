<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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

    elseif ( isset($_POST['userId'], $_POST['deleteAccount'], $_POST['password'])) {
        $mysqli = dbConnect();
        
        if($statement = $mysqli->prepare('SELECT password FROM accounts WHERE id = ?')) {
            $statement->bind_param('i', $_POST['userId']);
            $statement->execute();
            $statement->store_result();
            $statement->bind_result($password);
            $statement->fetch();

            if (password_verify($_POST['password'], $password)) {
                $isTaksDeleted = FALSE;
                if($statement = $mysqli->prepare('DELETE FROM tasks WHERE userId = ?')) {
                    $statement->bind_param('i', $_POST['userId']);
                    $statement->execute();

                    $isTaksDeleted = TRUE;
                } else {
                    echo 'Could not prepare statement';
                }

                $isAccountDeleted = FALSE;
                if($statement = $mysqli->prepare('DELETE FROM accounts WHERE id = ?')) {
                    $statement->bind_param('i', $_POST['userId']);
                    $statement->execute();

                    $isAccountDeleted = TRUE;
                } else {
                    echo 'Could not prepare statement';
                }

                if($isAccountDeleted && $isTaksDeleted) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = NULL;
                    header(("Location: ../index.php"));
                } else {
                    header("Location: ../accountinfo.php?modifyAccount=TRUE&action=deleteError");
                }
            } else {
                header("Location: ../accountinfo.php?modifyAccount=TRUE&action=unauthorized");
            }
        } else {
            echo 'Could not prepare statement';
        }
    }

    else {
        echo "invalid form data";
    }

?>
