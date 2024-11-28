<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['loggedin'])) {
        $showLogedInPages = TRUE;
    } else {
        $showLogedInPages = FALSE;
    }
?>
<nav>
    <div class="haushaltsplaner">Haushaltsplaner</div>
    <div class="links">
        <a href="index.php">Startseite</a>
        <a href="kontakt.php">Kontakt</a>
        <?php if(! $showLogedInPages): ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <?php if($showLogedInPages): ?>
            <a href="deinHaushaltsplan.php">Dein Haushaltsplan</a>
            <a href="accountinfo.php">Dein Account</a>
            <a href="php/logout.php">Logout</a>
        <?php endif; ?>
    </div>
</nav>
