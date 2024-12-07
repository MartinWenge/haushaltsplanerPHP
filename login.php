<?php 
    $newAccount = FALSE;
    if(isset($_GET['newAccount'])){
        $newAccount = TRUE;
    }

    $existingUsername = FALSE;
    if(isset($_GET['existingUsername'])){
        $existingUsername = TRUE;
    }

    $unauthorized = FALSE;
    if(isset($_GET['unauthorized'])){
        $unauthorized = TRUE;
    }

    $notBorn = FALSE;
    if(isset($_GET['notBorn'])){
        $notBorn = TRUE;
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
        <div class="login">
            
            <?php if($newAccount): ?>
                <div class="login-hinweis">
                    Willkommen <?=htmlspecialchars($_GET['newAccount'], ENT_QUOTES)?>, du kannst dich jetzt mit deinen Zugangsdaten einloggen.
                </div>
            <?php endif; ?>

            <?php if($existingUsername): ?>
                <div class="login-hinweis">
                    Dein gewählter Username <b><?=htmlspecialchars($_GET['existingUsername'], ENT_QUOTES)?></b> ist bereits vergeben, bitte wähle einen anderen.
                </div>
            <?php endif; ?>

            <?php if($unauthorized): ?>
                <div class="login-hinweis">
                    Nutzername oder Passwort nicht korrekt, bitte versuche es erneut.
                </div>
            <?php endif; ?>

            <?php if($notBorn): ?>
                <div class="login-hinweis">
                    Dein Geburtstag liegt in der Zukunft, das kann nicht sein...
                </div>
            <?php endif; ?>

            <div class="login-ueberschrift">Login</div>
            <form action="php/authenticate.php" method="post">
                <label for="username">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="username" placeholder="Benutzername" id="username" required>
                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" placeholder="Passwort" id="password" required>
                <input type="submit" value="Login">
            </form>

            <div class="neuerAccountHinweistext">
                Du hast noch keinen Account? Kein Problem, lege hier einfach einen Neuen an:
            </div>

            <div class="login-ueberschrift">Neuen Account anlegen</div>
			<form action="php/register.php" method="post" autocomplete="off">
				<label for="usernameNew">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="usernameNew" placeholder="Benutzername" id="username_new" required>
				<label for="passwordNew">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="passwordNew" placeholder="Passwort" id="password_new" required>
				<label for="emailNew">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="emailNew" placeholder="Email" id="email_new" required>
                <label for="birthdayNew">
					<i class="fas fa-birthday-cake"></i>
				</label>
				<input type="date" name="birthdayNew" placeholder="Geburtstag" id="birthday_new" required>
				<input type="submit" value="Account erstellen">
			</form>
		</div>
    </main>
    
    <?php include "includes/footer.php" ?>

</body>

</html>
