<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
	header('Location:login.php');
	exit;
}

require "php/functions.php";
if(isset($_SESSION['id'])){
    $userInfo = getAccountInfo($_SESSION['id']);
}

?>

<DOCTYPE html>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Haushaltsplaner</title>
</head>

<body>
    <?php include "includes/nav.php" ?>
    
    <main>
        <div class="accountinfo">
            <div class="accountinfo-ueberschrift">Deine Daten</div>
            <div class="information">
                <div>Name:</div>
                <div><?php echo $userInfo["username"] ?></div>
            </div>
            <div class="information">
                <div>Email:</div>
                <div><?php echo $userInfo["email"] ?></div>
            </div>
        </div>
        
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
