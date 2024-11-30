<?php require "php/functions.php" ?>

<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }

    if(isset($_GET['sortierung'])){
        $sortierung = urldecode($_GET['sortierung']);
    } else {
        $sortierung = "alle";
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
    <?php include "includes/header.php" ?>
    
    <main>
        <div class="seitenmenue">
            <div class="menue-ueberschrift">Deine Aufgaben</div>
            <a href="deinHaushaltsplan.php?sortierung=alle">alle Aufgaben</a>
            <a href="deinHaushaltsplan.php?sortierung=offen">offene Aufgaben</a>
            <a href="deinHaushaltsplan.php?sortierung=erledigt">erledigte Aufgaben</a>
        </div>

        <div class="inhaltsbereich">
            <div class="menue-ueberschrift">Deine Aufgabeliste:</div>
            <?php $aufgaben = getTasks($_SESSION['userId'], $sortierung); ?>
            <?php if(count($aufgaben) == 0): ?>
                <div class="aufgabeHaushaltsplan">Diese Liste ist leer.</div>
            <?php endif; ?>
            <?php foreach($aufgaben as $aufgabe): ?>
                <?php $datum = substr($aufgabe['datum'],-2,2) . "." . substr($aufgabe['datum'],5,2) . "." . substr($aufgabe['datum'],0,4);?>
                <div class="aufgabeHaushaltsplan">
                    <b><?=$aufgabe['name'] ?></b> (<?=$aufgabe['aufwand'] ?> min, <?=$aufgabe['score'] ?> Punkte), eingeplant am <b><?=$datum ?></b>.
                    <?php if($aufgabe['isDone'] == 0): ?>
                        <form action="php/aufgabeErledigt.php" method="post">
                            <input type="hidden" id="taskId" name="taskId" value="<?=$aufgabe['taskId']?>">
                            <input type="submit" name="submit-<?=$aufgabe['taskId'];?>" id="submit-<?=$aufgabe['taskId'];?>" value="auf erledigt setzen">
                        </form>
                    <?php endif; ?>
                    <?php if($aufgabe['isDone'] == 1): ?>
                        <div class="istErledigtLabel">Aufgabe schon erledigt</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
