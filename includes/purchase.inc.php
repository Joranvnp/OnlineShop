<?php
session_start();

if (isset($_POST['purchase-submit'])) {
    require 'dbh.inc.php';

    $uuid = $_SESSION['userUid'];
    $selectedRank = $_POST['selectedRank'];
    $email = $_POST['email'];
    $guthaben = $_SESSION['guthaben'];
    $redeemable = $_SESSION['redeemable'];

    $rank = $_SESSION['rang'];

    $sql = "SELECT rank FROM players WHERE uuid='$uuid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            unset($_SESSION['currentRank']);
            $_SESSION['currentRank'] = $row['rank'];
        }
    }

    $currentRank = $_SESSION['currentRank'];


    if ($selectedRank == 'oneMonth') {
        if ($_POST['agb'] == 'checked') {
            if ($guthaben >= 1000) {
                if (($currentRank == "NoRank") && ($redeemable == "None")) {

                    unset($_SESSION["guthaben"]);
                    $guthaben -= 1000;
                    $_SESSION['guthaben'] = $guthaben;
                    $sql = "UPDATE players SET guthaben='$guthaben' WHERE uuid='$uuid'";

                    if (mysqli_query($conn, $sql)) {

                        $sql2 = "UPDATE players SET redeemable='OneMonth' WHERE uuid='$uuid'";

                        if (mysqli_query($conn, $sql2)) {
                            header("Location: ../dashboard.php");
                            exit();
                        } else {
                            header("Location: ../purchase1.php?error=sqlerror");
                            exit();
                        }
                    } else {
                        header("Location: ../purchase1.php?error=sqlerror");
                        exit();
                    }
                } else {
                    header("Location: ../purchase1.php?error=alreadybought");
                    exit();
                }
            } else {
                header("Location: ../purchase1.php?error=notenough");
                exit();
            }
        } else {
            header("Location: ../purchase1.php?error=notchecked");
            exit();
        }
    } else if ($selectedRank == 'lifetime') {
        if ($_POST['agb'] == 'checked') {
            if ($guthaben >= 3500) {
                if ((($currentRank == "NoRank") || ($currentRank == "OneMonth")) && (($redeemable == "None") || ($redeemable == "OneMonth"))) {

                    unset($_SESSION["guthaben"]);
                    $guthaben -= 3500;
                    $_SESSION['guthaben'] = $guthaben;
                    $sql = "UPDATE players SET guthaben='$guthaben' WHERE uuid='$uuid'";

                    if (mysqli_query($conn, $sql)) {

                        $sql2 = "UPDATE players SET redeemable='Lifetime' WHERE uuid='$uuid'";

                        if (mysqli_query($conn, $sql2)) {
                            header("Location: ../dashboard.php");
                            exit();
                        } else {
                            header("Location: ../purchase2.php?error=sqlerror");
                            exit();
                        }
                    } else {
                        header("Location: ../purchase2.php?error=sqlerror");
                        exit();
                    }
                } else {
                    header("Location: ../purchase2.php?error=alreadybought");
                    exit();
                }
            } else {
                header("Location: ../purchase2.php?error=notenough");
                exit();
            }
        } else {
            header("Location: ../purchase2.php?error=notchecked");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}