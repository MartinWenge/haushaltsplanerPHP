<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'])) {
        header('Location:login.php');
        exit;
    }

    $isModifiedAccount = FALSE;
    $isPWChanged       = FALSE;
    $isUnauthorized    = FALSE;
    $isDeleteError     = FALSE;
    if(isset($_GET['modifyAccount'], $_GET['action'])){
        if($_GET['modifyAccount'] == TRUE){
            $isModifiedAccount = TRUE;
            if($_GET['action'] == "pwchanged"){
                $isPWChanged = TRUE;
            }
            if($_GET['action'] == "unauthorized"){
                $isUnauthorized = TRUE;
            }
            if($_GET['action'] == "deleteError"){
                $isDeleteError = TRUE;
            }
        }
    }

    require "php/functions.php";
    if(isset($_SESSION['userId'])){
        $userInfo = getAccountInfo($_SESSION['userId']);
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
        <div class="accountinfo">
            <?php if($isModifiedAccount): ?>

                <?php if($isPWChanged): ?>
                    <div class="hinweis">
                        Du hast dein Passwort erfolgreich aktualisiert. <i class="fas fa-thumbs-up"></i>
                    </div>
                <?php endif; ?>

                <?php if($isUnauthorized): ?>
                    <div class="hinweis">
                        Das war nix. Bitte gib dein aktuelles Passwort zur Bestätigung ein. <i class="far fa-times-circle"></i>
                    </div>
                <?php endif; ?>

                <?php if($isDeleteError): ?>
                    <div class="hinweis">
                        Das hat nicht geklappt, bitte versuche es nochmal. <i class="fas fa-bug"></i>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="accountinfo-ueberschrift">Deine Daten</div>
            <div class="infobox">
                <div class="information">
                    <div>Name:</div>
                    <div><?php echo $userInfo["username"] ?></div>
                </div>
                <div class="information">
                    <div>Email:</div>
                    <div><?php echo $userInfo["email"] ?></div>
                </div>
                <div class="information">
                    <div>Geburtsdatum:</div>
                    <div><?php echo formatiereDatum($userInfo["birthday"]) ?></div>
                </div>
            </div>
            
            <div class="formbox">
                <div class="accountinfo-ueberschrift">Passwort ändern</div>
                <form action="php/changeAccountInfo.php" method="post">
                    <label for="password">
                        <i class="fas fa-lock-open"></i>
                    </label>
                    <input type="password" name="password" placeholder="altes Passwort" id="password" required>
                    <label for="passwordNeu">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="passwordNeu" placeholder="neues Passwort" id="passwordNeu" required>
                    <input type="hidden" id="userId" name="userId" value="<?=$userInfo['userId']?>">
                    <input type="submit" value="Passwort ändern">
                </form>
            </div>

            <div class="formbox">
                <div class="accountinfo-ueberschrift">Account löschen</div>
                Achtung, hierdurch werden alle deine bisher eingeplanten Aufgaben und dein Account unwiederruflich gelöscht.
                <form action="php/changeAccountInfo.php" method="post">
                    <label for="password">
                        <i class="fas fa-lock-open"></i>
                    </label>
                    <input type="password" name="password" placeholder="aktuelles Passwort" id="password" required>
                    <input type="hidden" id="userId" name="userId" value="<?=$userInfo['userId']?>">
                    <input type="hidden" id="deleteAccount" name="deleteAccount" value="deleteAccount">
                    <input type="submit" value="Account löschen">
                </form>
            </div>            

        </div>
        
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
