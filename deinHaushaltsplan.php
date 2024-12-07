<?php require "php/functions.php" ?>

<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }

    if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];
    }

    if(isset($_GET['startdatum'])){
        $startdatum = $_GET['startdatum'];
    } else {
        $startdatum = date("Y-m-d");
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
    <?php include "includes/header.php" ?>
    
    <main>
        <div class="seitenmenue">
            <div class="menue-ueberschrift">Neue Aufgabe</div>
            <?php $kategorien = getKategorien() ?>
            <?php 
                foreach($kategorien as $kategorie){
                    ?>
                        <a href="kategorie.php?category=<?php echo urlencode($kategorie['kategorie']) ?>"><?php echo $kategorie['kategorie'] ?></a>
                    <?php
                }
            ?>
        </div>

        <div class="inhaltsbereich">
            <div class="menue-ueberschrift">Dein Aufgabenkalender</div>

            <div class="container-navigation-kalender">

                <div class="navigation-woche viertel-drehung">
                    <a href="deinHaushaltsplan.php?startdatum=<?=datumEineWocheEher($startdatum); ?>"> eine Woche früher</a>
                </div>

                <div class="container-haushaltsplan-kalender">
                    <?php $wochenaufgaben = getWochenaufgaben($startdatum,$userId); ?>
                    <?php foreach($wochenaufgaben as $tag): ?>
                        <div class="element-haushaltsplan-kalender">
                            <div class="datum"><?=formatiereDatumUndTag($tag['datum'])?></div>
                            <?php foreach($tag['aufgaben'] as $aufgabe): ?>
                                <div class="aufgaben">
                                    <div class="aufgabenname"><?=$aufgabe["name"];?></div>
                                    <div class="aufgabenbuttons">
                                        <div>
                                            <form action="php/aufgabeErledigt.php" method="post">
                                                <input type="hidden" id="taskId" name="taskId" value="<?=$aufgabe['id']?>">
                                                <input type="submit" name="submit" id="submit" value="&#xf00c;">
                                            </form>
                                        </div>
                                        <div>
                                            <form action="aufgabeBearbeiten.php" method="post">
                                                <input type="hidden" id="taskId" name="taskId" value="<?=$aufgabe['id']?>">
                                                <input type="submit" name="submit" id="submit" value="&#xf013;">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="navigation-woche viertel-drehung">
                    <a href="deinHaushaltsplan.php?startdatum=<?=datumEineWocheSpaeter($startdatum); ?>"> eine Woche später</a>
                </div>

            </div>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
