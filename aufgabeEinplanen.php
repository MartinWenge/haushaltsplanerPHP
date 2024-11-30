<?php require "php/functions.php" ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
	header('Location:login.php');
	exit;
}

if (!isset($_GET['userId']) || !isset($_GET['aufgabeId'])){
    header('Location:index.php');
	exit;
}
?>

<DOCTYPE html>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Haushaltsplaner</title>
</head>

<body>
    <?php include "includes/nav.php" ?>
    
    <main>
        <div class="aufgabenbeschreibung">
            <div class="aufgbeschr-ueberschrift">Plane folgende Aufgabe ein:</div>

            <?php $aufgabe = getAufgabeById($_GET['aufgabeId']) ?>

            <div class="eigenschaft">
                <div>Name:</div>
                <div><?=$aufgabe['name']?></div>
            </div>

            <div class="eigenschaft">
                <div>Häufigkeit:</div>
                <div><?=$aufgabe['haeufigkeit']?></div>
            </div>

            <div class="eigenschaft">
                <div>Aufwand:</div>
                <div><?=$aufgabe['aufwand']?></div>
            </div>

            <div class="formBeschreibung">Wann soll die Aufgabe das erste Mal eingeplant werden und wie oft?</div>
            <form action="php/planeAufgabeEin.php" method="post">
                <label for="startdatum">
                    <i class="fas fa-calendar"></i>
                </label>
                <input type="date" name="startdatum" placeholder="Startdatum" id="startdatum" value="<?= date('Y-m-d');?>" required>
                <label for="repeat">
                    <i class="fas fa-calendar-plus"></i>
                </label>
                <input type="number" name="repeat" placeholder="wie oft einplanen? (max. 10)" id="repeat" max=10 required>
                <input type="hidden" id="aufgabenId" name="aufgabenId" value="<?=$aufgabe['id']?>">
                <input type="hidden" id="userId" name="userId" value="<?=htmlspecialchars($_GET['userId'], ENT_QUOTES)?>">
                <input type="submit" value="Einplanen">
            </form>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
