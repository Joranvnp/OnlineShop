<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <title></title>
</head>
<body>

<main>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <img src="img/logo.png">
                <h3>OnlineShop</h3>
                <h6><i class="fas fa-angle-right"></i> Anmelden <i class="fas fa-angle-left"></i></h6>

                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p style="color: red">Bitte fülle alle Felder aus</p>';
                    } else if ($_GET['error'] == "sqlerror") {
                        echo '<p style="color: red">Datenbankfehler. Bitte melde dies einem Administrator.</p>';
                    } else if ($_GET['error'] == "wrongpwd") {
                        echo '<p style="color: red">Ungültiges Passwort.</p>';
                    } else if ($_GET['error'] == "nouser") {
                        echo '<p style="color: red">Account nicht gefunden.</p>';
                    } else if ($_GET['error'] == "alreadyloggedin") {
                        echo '<p style="color: red">Du bist bereits eingeloggt.</p>';
                    }
                }
                ?>

                <form action="includes/login.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" value="" name="uuiduid"
                               placeholder="InGame-Name">
                    </div>

                    <div class="form-group">
                        <input type="password" value="" name="pwd" placeholder="Passwort">
                    </div>
                    <div class="form-group">
                        <?php
                        if (!isset($_SESSION['userId'])) {
                            echo '<button type="submit" class="btnSubmit" name="login-submit"><i
                                        class="fas fa-sign-in-alt"></i>Anmelden
                            </button>';
                        }
                        ?>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['userId'])) {
                    echo '<form action="includes/logout.inc.php" method="post">
                       <button type="submit" class="btnLogout" name="logout-submit"><i class="fas fa-sign-out-alt"></i>Abmelden
                            </button>
                       </form>';
                }
                ?>
            </div>
            <div class="col-md-6 login-form-2">
                <h3>So funktionierts..</h3>
                <h6><i class="fas fa-angle-right"></i> Erstellen eines Shop-Accounts <i
                            class="fas fa-angle-left"></i></h6>
                <p><b>1.</b> Führe In-Game den Befehl <b>/account create</b> aus.</p>
                <p><b>2.</b> Erstelle dir einen <b>Account</b> mit einem von dir gewählten Passwort.</p>
                <p><b>3.</b> Logge dich mit deinem <b>InGame-Namen</b> und <b>Passwort</b> ein.</p>
                <p><b>4.</b> Viel Spaß beim <b>Shoppen</b>!</p>
                <br>
                <p>Bei Fragen oder Problemen kannst du mich jederzeit über <b>Twitter</b> oder <b>Discord</b>
                    erreichen.
                </p>
                <br>
                <div class="link">
                    <i class="fab fa-twitter"></i><b class="twitter">Twitter</b><a
                            href="https://twitter.com/einpume" target="_blank">@einpume</a><br>
                    <i class="fab fa-discord"></i><b class="discord">Discord</b><a href="https://discord.gg/s4vQkQy"
                                                                                   target="_blank">pume#2980</a>
                </div>

            </div>
        </div>
    </div>
</main>
<footer>

</footer>
</body>
</html>
