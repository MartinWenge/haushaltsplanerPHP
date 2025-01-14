<?php require "php/functions.php" ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
	header('Location:login.php');
	exit;
}

    $incompleteForm = FALSE;
    if(isset($_GET['incompleteForm'])){
        $incompleteForm = TRUE;
    }

    $directCall = FALSE;
    if(isset($_GET['directCall'])){
        $directCall = TRUE;
    }

    $imageError = FALSE;
    if(isset($_GET['imageError'])){
        $imageError = TRUE;
    }

    $databaseError = FALSE;
    if(isset($_GET['databaseError'])){
        $databaseError = TRUE;
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
        <div class="neue-aufgabe-anlegen">

            <?php if($incompleteForm): ?>
                <div class="submit-message">
                    Bitte fülle alle Felder des Formulars aus.
                </div>
            <?php endif; ?>

            <?php if($directCall): ?>
                <div class="submit-message">
                    Bitte lege eine neue Aufgabe nur über das Eingabeformular an.
                </div>
            <?php endif; ?>

            <?php if($imageError): ?>
                <div class="submit-message">
                    Fehler beim Bildupload. Bitte nutze ein png oder jpg mit maximal 500kB Größe.
                </div>
            <?php endif; ?>

            <?php if($databaseError): ?>
                <div class="submit-message">
                    Fehler beim anlegen der Aufgabe in der Datenbank. Hast du ungewöhnliche Zeichen benutzt?
                </div>
            <?php endif; ?>

            <div class="aufgbeschr-ueberschrift">Lege eine neue Aufgabe an:</div>

            <form action="php/neueAufgabe.php" method="post" enctype="multipart/form-data">
                <label for="name">
                    <i class="fas fa-comment"></i>
                </label>
                <input type="text" name="name" placeholder="Name" id="name" required>

                <label for="kategorie">
                    <i class="fas fa-suitcase"></i>
                </label>
                <input type="text" name="kategorie" placeholder="Kategorie" id="kategorie" required>

                <label for="beschreibung">
                    <i class="fas fa-comments"></i>
                </label>
                <input type="text" name="beschreibung" placeholder="Beschreibung" id="beschreibung" required>

                <div class="formBeschreibung">Wie lange (in Minuten) brauchst du für diese Aufgabe?</div>
                <label for="aufwand">
                    <i class="fas fa-hourglass-half"></i>
                </label>
                <input type="number" name="aufwand" value="20" id="aufwand" required>

                <div class="formBeschreibung">Wie viele Punkte ist diese Aufgabe wert?</div>
                <label for="score">
                    <i class="fas fa-star"></i>
                </label>
                <input type="number" name="score" value="10" id="score" required>

                <div class="formBeschreibung">Wie häufig führst du diese Aufgabe typischerweise aus?</div>
                <label for="haufigkeit">
                    <i class="fas fa-calendar-plus"></i>
                </label>

                <?php $listeHaeufigkeit = getListeHaeufigkeit(); ?>
                <select name="haeufigkeit" id="haeufigkeit" required>
                    <?php foreach($listeHaeufigkeit as $haeufigkeit): ?>
                        <option value=<?=$haeufigkeit["id"];?>><?=$haeufigkeit["name"];?></option>
                    <?php endforeach; ?>
                </select>

                <div class="formBeschreibung">Suche ein passendes Bild heraus.</div>
                <label for="bild">
                    <i class="fas fa-file-image"></i>
                </label>
                <input type="file" name="bild" placeholder="Pfad zum Bild" id="bild" required>

                <input type="submit" value="Aufgabe anlegen">
            </form>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
