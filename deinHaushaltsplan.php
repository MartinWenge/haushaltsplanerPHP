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

    if(isset($_GET['sortierung'])){
        $sortierung = urldecode($_GET['sortierung']);
    } else {
        $sortierung = "alle";
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

            <div class="menue-ueberschrift seitenmenue-trenner">Deine Aufgaben</div>
            <a href="deinHaushaltsplan.php?sortierung=alle">alle Aufgaben</a>
            <a href="deinHaushaltsplan.php?sortierung=offen">offene Aufgaben</a>
            <a href="deinHaushaltsplan.php?sortierung=erledigt">erledigte Aufgaben</a>
        </div>

        <div class="inhaltsbereich">
            <div class="menue-ueberschrift">Dein Aufgabenkalender</div>
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

<!--
                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Montag, 02.12.2024</div>
                    <div class="aufgaben">
                        <ul>
                            <li>Wäsche waschen</li>
                            <li>Wäsche trocknen</li>
                        </ul>
                    </div>
                </div>

                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Dienstag, 03.12.2024</div>
                    <div class="aufgaben"></div>
                </div>
                
                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Mittwoch, 04.12.2024</div>
                    <div class="aufgaben">
                        <ul>
                            <li>Wäsche legen</li>
                        </ul>
                    </div>
                </div>

                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Donnerstag, 05.12.2024</div>
                    <div class="aufgaben"></div>
                </div>

                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Freitag, 06.12.2024</div>
                    <div class="aufgaben"></div>
                </div>

                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Samstag, 07.12.2024</div>
                    <div class="aufgaben">
                        <ul>
                            <li>Wäsche waschen</li>
                            <li>Wäsche trocknen</li>
                        </ul>
                    </div>
                </div>

                <div class="element-haushaltsplan-kalender">
                    <div class="datum">Sonnatg, 08.12.2024</div>
                    <div class="aufgaben"></div>
                </div>
                
            </div>
-->

<!--
            <div class="menue-ueberschrift">Deine Aufgabeliste:</div>
            <?php $aufgaben = getTasks($userId, $sortierung); ?>
            <?php if(count($aufgaben) == 0): ?>
                <div class="aufgabeHaushaltsplan">Diese Liste ist leer.</div>
            <?php endif; ?>
            <?php foreach($aufgaben as $aufgabe): ?>
                <?php $datum = formatiereDatum($aufgabe['datum']); ?>
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
-->
        </div>

    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
