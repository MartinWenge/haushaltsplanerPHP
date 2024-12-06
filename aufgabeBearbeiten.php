<?php require "php/functions.php" ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'],$_POST['taskId'])) {
	header('Location:login.php');
	exit;
}
?>

<DOCTYPE html>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Haushaltsplaner</title>
</head>

<body>
    <?php include "includes/nav.php" ?>
    
    <main>
        <div class="aufgabenbeschreibung">
            <div class="aufgbeschr-ueberschrift">Du bearbeitest folgende Aufgabe:</div>

            <?php $aufgabe = getTaskById($_POST['taskId']) ?>

            <div class="eigenschaft">
                <div>Datum:</div>
                <div><?=formatiereDatum($aufgabe['datum'])?></div>
            </div>

            <div class="eigenschaft">
                <div>Name:</div>
                <div><?=$aufgabe['name']?></div>
            </div>

            <div class="eigenschaft">
                <div>Aufwand:</div>
                <div><?=$aufgabe['aufwand']?></div>
            </div>

            <div class="eigenschaft">
                <div>Score:</div>
                <div><?=$aufgabe['score']?></div>
            </div>

            <div class="formBeschreibung">Möchtest du das Datum der Aufgabe ändern?</div>

            <form action="php/aufgabeDatumNeu.php" method="post">
                <label for="neuesDatum">
                    <i class="fas fa-calendar"></i>
                </label>
                <input type="date" name="neuesDatum" placeholder="neuesDatum" id="neuesDatum" value="<?= $aufgabe['datum'];?>" required>
                <input type="hidden" id="taskIdChange" name="taskIdChange" value="<?=$aufgabe['id']?>">
                <input type="submit" value="Neues Datum setzen">
            </form>

            <div class="formBeschreibung">Möchtest du die Aufgabe auf erledigt setzen?</div>
            <form action="php/aufgabeErledigt.php" method="post">
                <input type="hidden" id="taskId" name="taskId" value="<?=$aufgabe['id']?>">
                <input type="submit" value="Aufgabe erledigt">
            </form>

        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
