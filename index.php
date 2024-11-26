<?php require "php/functions.php" ?>
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
            <div class="menue-ueberschrift">Kathegorien</div>
            <?php $kathegorien = getKathegorien() ?>
            <?php 
                foreach($kathegorien as $kathegorie){
                    ?>
                        <a href="kathegorie.php?cathegory=<?php echo urlencode($kathegorie['kathegorie']) ?>"><?php echo $kathegorie['kathegorie'] ?></a>
                    <?php
                }
            ?>
        </div>

        <div class="inhaltsbereich">
            <div class="menue-ueberschrift">Details Aufgaben</div>
            <?php $aufgaben = getAlleAufgaben() ?>
            <?php foreach($aufgaben as $aufgabe){
                ?>
                    <div class="aufgabe">
                        <div class="aufgabe-bild">
                            <img src="<?php echo $aufgabe['bild']?>" alt="figures/aufgabe_altImg_640.jpg">
                        </div>
                        <div class="aufgabe-text">
                            <div class="aufgabe-name"><?php echo $aufgabe['name'] ?></div>
                            <div class="aufgabe-eigenschaften">
                                <div class="eigenschaft">
                                    <div>Häufigkeit:</div>
                                    <div><?php echo $aufgabe['haeufigkeit'] ?></div>
                                </div>
                                <div class="eigenschaft">
                                    <div>Aufwand:</div>
                                    <div><?php echo $aufgabe['aufwand'] ?> Minuten</div>
                                </div>
                                <div class="eigenschaft">
                                    <div>Beschreibung:</div>
                                    <div><?php echo $aufgabe['beschreibung'] ?></div>
                                </div>
                                <div class="eigenschaft">
                                    <div>Score:</div>
                                    <div><?php echo $aufgabe['score'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
            ?>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

    <script src="javascript/script.js"></script>
</body>

</html>
