<?php
session_start();

if (!isset($_SESSION['userUid'])) {
    header("Location: ../index.php");
    exit();
}

$rank = $_SESSION['rang'];
$redeemable = $_SESSION['redeemable'];
$guthaben = $_SESSION['guthaben'];
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
    <link rel="stylesheet" type="text/css" href="css/style-purchase.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <title></title>
</head>
<body>

<main>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-3 login-form-1">
                <h2>SHOP</h2>
                <hr>
                <nav class="nav flex-column nav">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="shop.php">Zum Shop</a>
                    <a class="nav-link active" href="">Lebenslang Premium</a>
                </nav>
            </div>
            <div class="col-md-9 login-form-2">
                <h1>Lebenslang Premium</h1>
                <h6>Information & Kauf</h6>

                <form action="includes/purchase.inc.php" method="post">
                    <select name="selectedRank" hidden>
                        <option value="lifetime"></option>
                    </select>

                    <div>
                        <p>Mit dem Erwerb des <b>Premium-Ranges</b> hast du <b>zahlreiche Vorteile</b> in Verbindung mit
                            DeinServer.net!
                            Unter anderem wirst auf auf dem Netzwerk <b>farblich hervorgehoben</b> und besitzt mehr <b>Features</b>
                            als ein normaler Spieler.</p><br>
                    </div>
                    <p>Eine Auflistung alles Fähigkeites dieses Ranges findest du hier:</p>
                    <hr>
                    <div class="listedFeatures">
                        <h2>Features</h2>
                        <table>
                            <tr>
                                <th><i class="fas fa-user-friends"></i></th>
                                <td>Mehr Freunde</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-tags"></i></th>
                                <td>Premium-Nametag</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-sign-in-alt"></i></th>
                                <td>Volle Server betreten</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-bold"></i></th>
                                <td>Exklusiver Beta-Zugang</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-heart"></i></th>
                                <td>Unterstütze uns!</td>
                            </tr>
                        </table>
                    </div>
                    <hr>

                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "notenough") {
                            echo '<label style="color: red">Dein Guthaben reicht nicht aus.</label>';
                        } else if ($_GET['error'] == "sqlerror") {
                            echo '<label style="color: red">Datenbankfehler. Bitte melde dies einem Administrator.</label>';
                        } else if ($_GET['error'] == "notchecked") {
                            echo '<label style="color: red">Bitte akzeptiere die allgemeinen Geschäftsbedingungen.</label>';
                        } else if ($_GET['error'] == "alreadybought") {
                            echo '<label style="color: red">Du hast diesen Rang bereits gekauft. Versuche ihn einzulösen, falls noch nicht getan.</label>';
                        }
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['userId'])) {
                        if (($guthaben >= 3500) && ($redeemable != "Lifetime") && ($rank != "Premium (Lifetime)")) {
                            echo '<div>
                                    <input type="checkbox" value="checked" name="agb" placeholder="InGame-Name"> Hiermit aktzeptiere
                                    ich die <a href="">Allgemeinen Geschäftsbedingungen</a>.
                                    </div>';
                            echo '<button type="submit" class="btnSubmit" name="purchase-submit">Kaufen (3.500 <i class="fab fa-cuttlefish"></i>)
                            </button>';
                        } else {
                            if ($guthaben < "3500") {
                                echo '<button type="button" class="btnSubmit" name="purchase-submit" disabled>Kaufen (3.500 <i class="fab fa-cuttlefish"></i> - Nicht genügend Guthaben)
                            </button>';
                            } else if ($redeemable == "Lifetime" || $rank == "Premium (Lifetime)") {
                                echo '<button type="button" class="btnSubmit" name="purchase-submit" disabled>Kaufen (3.500 <i class="fab fa-cuttlefish"></i> - Rang bereits gekauft)
                            </button>';
                            }
                        }
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>
</main>
<footer>

</footer>
</body>
</html>
