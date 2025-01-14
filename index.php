<?php require "php/functions.php" ?>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['loggedin'])) {
        $isLoggedIn = TRUE;
    } else {
        $isLoggedIn = FALSE;
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
            <div class="menue-ueberschrift-container">
                <div class="menue-ueberschrift">Mögliche Aufgaben</div>
                <?php if($isLoggedIn): ?>
                    <div class="menue-button">
                        <form action="neueAufgabeAnlegen.php" method="post">
                            <input type="submit" name="submit" id="submit" value="neue Aufgabe anlegen">
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php $aufgaben = getAlleAufgaben() ?>
            <?php foreach($aufgaben as $aufgabe): ?>
                <?php if($isLoggedIn): ?>
                    <a href="aufgabeEinplanen.php?userId=<?=htmlspecialchars($_SESSION['userId'], ENT_QUOTES)?>&aufgabeId=<?=$aufgabe["id"]?>" >
                <?php endif; ?>
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
                <?php if($isLoggedIn): ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
