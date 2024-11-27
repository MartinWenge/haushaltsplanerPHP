<?php require "php/functions.php" ?>

<?php 
    if(isset($_GET['category'])){
        $seitenKategorie = urldecode($_GET['category']);
    }else{
        $seitenKategorie = "*";
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
            <div class="menue-ueberschrift">Kategorien</div>
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
            <div class="menue-ueberschrift">Details Aufgaben</div>
            <?php $aufgaben = getAufgabenNachKategorie($seitenKategorie) ?>
            <?php foreach($aufgaben as $aufgabe){
                ?>
                    <div class="aufgabe">
                        <div class="aufgabe-bild">
                            <img src="<?php 
                                if (! empty($aufgabe['bild'])){
                                    echo $aufgabe['bild'];
                                } else {
                                    echo "figures/aufgabe_altImg_640.jpg";
                                }
                            ?>" alt="Bild der Aufgabe.">
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
