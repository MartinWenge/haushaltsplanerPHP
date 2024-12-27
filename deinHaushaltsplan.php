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

    // default:
    $wochenplan = TRUE;
    $monatsplan = FALSE;
    if(isset($_GET['wochenplan']) || isset($_GET['monatsplan'])){
        if(isset($_GET['wochenplan'])){
            $wochenplan = TRUE;
            $monatsplan = FALSE;
        }
        if(isset($_GET['monatsplan'])){
            $wochenplan = FALSE;
            $monatsplan = TRUE;
        }
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
    
    <main style="margin-top: 15px;">
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
            <div class="auswahl-ansicht">
                <a <?php if($wochenplan):?> style="border-color:var(--headline-font-color);border-width:3px" <?php endif; ?> href="deinHaushaltsplan.php?startdatum=<?=$startdatum; ?>&wochenplan=TRUE"> Wochenplan </a>
                <div class="auswahl-startdatum">
                    <form action="php/auswahlStartdatum.php" method="post">
                        <input type="date" id="startdatum" name="startdatum" value="<?=$startdatum?>">
                        <input type="hidden" id="ansicht" name="ansicht" value="<?=$wochenplan?>">
                        <input type="submit" name="submit" id="submit1" value="&#xf00c;">
                    </form>
                </div>
                <a <?php if($monatsplan):?> style="border-color:var(--headline-font-color);border-width:3px" <?php endif; ?> href="deinHaushaltsplan.php?startdatum=<?=$startdatum; ?>&monatsplan=TRUE"> Monatsplan </a>
            </div>

            <div class="container-navigation-kalender">

                <?php if($wochenplan): ?>
                    <div class="navigation-woche viertel-drehung">
                        <a href="deinHaushaltsplan.php?startdatum=<?=datumEineWocheEher($startdatum); ?>"> eine Woche früher</a>
                    </div>

                    <div class="container-haushaltsplan-kalender top-margin">
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
                                                    <input type="submit" name="submit" id="submit2" value="&#xf00c;">
                                                </form>
                                            </div>
                                            <div>
                                                <form action="aufgabeBearbeiten.php" method="post">
                                                    <input type="hidden" id="taskId" name="taskId" value="<?=$aufgabe['id']?>">
                                                    <input type="submit" name="submit" id="submit3" value="&#xf013;">
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
                <?php endif; ?>

                <?php if($monatsplan): ?>
                    <div class="navigation-woche viertel-drehung">
                        <a href="deinHaushaltsplan.php?monatsplan=TRUE&startdatum=<?=ersterEinMonatEher($startdatum); ?>"> ein Monat eher</a>
                    </div>

                    <div>
                        <?php $monatsaufgaben = getMonatsaufgaben($startdatum,$userId);?>
                        <?php foreach($monatsaufgaben as $index => $tag): ?>
                            <?php if(($index % 7) == 0): ?>
                            <?php $offen=TRUE; ?>
                            <div class="container-haushaltsplan-kalender">
                            <?php endif; ?>
                                <div class="element-haushaltsplan-kalender">
                                <div class="datum" <?php if((($index+1)%7 ==0) && $index>0):?>style="background-color: lightgray"<?php endif; ?>><?=formatiereDatumUndTag($tag['datum'])?></div>
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
                            <?php if(($index > 0) && (($index+1) % 7) == 0): ?>
                            <?php $offen=FALSE; ?>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($offen): ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="navigation-woche viertel-drehung">
                        <a href="deinHaushaltsplan.php?monatsplan=TRUE&startdatum=<?=ersterEinMonatSpaeter($startdatum); ?>"> ein Monat später</a>
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
