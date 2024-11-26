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
            <a href="kueche">Küche</a>
            <a href="bad">Bad</a>
            <a href="waesche">Wäsche</a>
        </div>

        <div class="inhaltsbereich">
            <div class="menue-ueberschrift">Details</div>
            <div class="aufgabe">
                <div class="aufgabe-bild">
                    <img src="figures/aufgabe_waescheWaschen_640.jpg" alt="figures/aufgabe_altImg_640.jpg">
                </div>
                <div class="aufgabe-text">
                    <div class="aufgabe-name">Wäsche waschen</div>
                    <p>Häufigkeit: alle zwei Tage</p>
                    <p>Aufwand: 15 min</p>
                    <p>Beschreibung: Wäsche sortieren, Waschmaschine befüllen, Waschmittel rein und starten</p>
                    <p>Score: 10</p>
                </div>
            </div>
            <div class="aufgabe">
                <div class="aufgabe-bild">
                    <img src="figures/aufgabe_waescheTrocknen_640.jpg" alt="figures/aufgabe_altImg_640.jpg" >
                </div>
                <div class="aufgabe-text">
                    <div class="aufgabe-name">Wäsche trocknen</div>
                    <p>Häufigkeit: alle zwei Tage</p>
                    <p>Aufwand: 30 min</p>
                    <p>Beschreibung: Wäsche aus der Waschmaschine holen und entweder aufhängen oder im Trockner trocknen</p>
                    <p>Score: 20</p>
                </div>
            </div>
            <div class="aufgabe">
                <div class="aufgabe-bild">
                    <img src="figures/aufgabe_waescheLegen_640.jpg" alt="figures/aufgabe_altImg_640.jpg">
                </div>
                <div class="aufgabe-text">
                    <div class="aufgabe-name">Wäsche legen</div>
                    <p>Häufigkeit: alle zwei Tage</p>
                    <p>Aufwand: 30 min</p>
                    <p>Beschreibung: trockene Wäsche legen und am besten gleich in den passenden Schrank einräumen</p>
                    <p>Score: 20</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

    <script src="javascript/script.js"></script>
</body>

</html>
