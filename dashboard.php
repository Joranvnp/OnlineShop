<?php
session_start();

if (!isset($_SESSION['userUid'])) {
    header("Location: ../index.php");
    exit();
}

require 'includes/dbh.inc.php';

$uid = $_SESSION['userId'];
$uuid = $_SESSION['userUid'];

$sql = "SELECT guthaben FROM players WHERE uuid='$uuid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        unset($_SESSION['guthaben']);
        $_SESSION['guthaben'] = $row['guthaben'];
    }
}

$guthaben = $_SESSION['guthaben'];

$sql2 = "SELECT rank FROM players WHERE uuid='$uuid'";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        unset($_SESSION['rang']);
        if ($row2['rank'] == 'NoRank') {
            $_SESSION['rang'] = 'Kein Rang';
        } else if ($row2['rank'] == 'OneMonth') {
            $_SESSION['rang'] = 'Premium (1 Monat)';
        } else if ($row2['rank'] == 'Lifetime') {
            $_SESSION['rang'] = 'Premium (Lifetime)';
        }
    }
}

$rank = $_SESSION['rang'];

$sql3 = "SELECT redeemable FROM players WHERE uuid='$uuid'";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        unset($_SESSION['redeemable']);
        $_SESSION['redeemable'] = $row3['redeemable'];
    }
}

if ($_SESSION['redeemable'] == "None") {
    $redeemable = "Kein Rang zum Einlösen verfügbar.";
} else if ($_SESSION['redeemable'] == "OneMonth") {
    $redeemable = "Premium (1 Monat).";
} else if ($_SESSION['redeemable'] == "Lifetime") {
    $redeemable = "Premium (Lifetime).";
}

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
    <link rel="stylesheet" type="text/css" href="css/style-dashboard.css">
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
                    <a class="nav-link active" href="">Dashboard</a>
                    <a class="nav-link" href="shop.php">Zum Shop</a>
                </nav>
            </div>
            <div class="col-md-9 login-form-2">

                <?php
                echo '<img style="width: 64px; height: 64px; margin-bottom: 20px" src="https://crafatar.com/renders/head/' . $uuid . '">';
                echo '<h1>Heji, ' . $uid . '</h1>';

                ?>
                <h6>Hier eine kurze Übersicht</h6>

                <?php

                echo '<button class="btnInfo" name=""><b>Dein Guthaben:</b> ' . $guthaben . ' <i class="fab fa-cuttlefish"></i></button>';
                echo '<button type="button" class="btnInfo"><b>Verknüpfte UUID:</b> ' . $uuid . '</button>';
                if ($rank != "Kein Rang") {
                    echo '<button type="button" class="btnInfo"><b>Eingelöster Rang:</b> ' . $rank . '</button>';
                }
                echo '<button type="button" class="btnInfo"><b>Einlösbarer Rang:</b> ' . $redeemable . '</button>';

                ?>

                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" class="btnLogout" name="logout-submit"><i class="fas fa-log-out"></i>Abmelden
                    </button>
                </form>


            </div>
        </div>
    </div>
</main>
</body>
</html>
