<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['userId'])) {
        header('Location:login.php');
        exit;
    }

    $isUnauthorized = FALSE;
    if(isset($_GET['action'])){
        if($_GET['action'] == "unauthorized"){
            $isUnauthorized = TRUE;
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
    
    <main>
        <div class="twofapage">
            <?php if($isUnauthorized): ?>
                <div class="hinweis">
                    <div>Antwort nicht korrekt, versuche es noch einmal.</div>
                    <i class="far fa-times-circle"></i>
                </div>
            <?php endif; ?>

            <div class="twofapage-ueberschrift">Zwei Faktor Check</div>

            <?php $random = random_int(0,2);?>

            <div class="twofaaufgabe">
                <?php if($random == 0): ?>
                
                    In welchem Jahr bist du geboren? (vierstellige Jahreszahl)
                    <form action="php/2facheck.php" method="post">
                        <label for="answer">
                            <i class="fas fa-calendar-alt"></i>
                        </label>
                        <input type="text" name="answer" placeholder="Antwort" id="answer" required>
                        <input type="hidden" id="userId" name="userId" value="<?=$_SESSION['userId']?>">
                        <input type="hidden" id="geburtstagsjahr" name="geburtstagsjahr" value="geburtstagsjahr">
                        <input type="submit" value="Antwort absenden">
                    </form>
                <?php endif; ?>
            
                <?php if($random == 1): ?>
                    In welchem Monat bist du geboren? (Zahl von 1-12)
                    <form action="php/2facheck.php" method="post">
                        <label for="answer">
                            <i class="fas fa-calendar-alt"></i>
                        </label>
                        <input type="text" name="answer" placeholder="Antwort" id="answer" required>
                        <input type="hidden" id="userId" name="userId" value="<?=$_SESSION['userId']?>">
                        <input type="hidden" id="geburtstagsmonat" name="geburtstagsmonat" value="geburtstagsmonat">
                        <input type="submit" value="Antwort absenden">
                    </form>
                <?php endif; ?>

                <?php if($random == 2): ?>
                    Am wievielten des Monats bist du geboren? (Zahl von 1-31)
                    <form action="php/2facheck.php" method="post">
                        <label for="answer">
                            <i class="fas fa-calendar-alt"></i>
                        </label>
                        <input type="text" name="answer" placeholder="Antwort" id="answer" required>
                        <input type="hidden" id="userId" name="userId" value="<?=$_SESSION['userId']?>">
                        <input type="hidden" id="geburtstagstag" name="geburtstagstag" value="geburtstagstag">
                        <input type="submit" value="Antwort absenden">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
