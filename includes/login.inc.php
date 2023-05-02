<?php
if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $uuiduid = $_POST['uuiduid'];
    $password = $_POST['pwd'];

    if (empty($uuiduid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM players WHERE uid=? OR uuid=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $uuiduid, $uuiduid);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if (md5($password) == $row['password']) {
                    session_start();
                    $_SESSION['userId'] = $row['uid'];
                    $_SESSION['userUid'] = $row['uuid'];
                    $_SESSION['guthaben'] = $row['guthaben'];
                    if ($row['rank'] == 'NoRank') {
                        $_SESSION['rang'] = 'Du hast noch keinen Premium-Rang gekauft';
                    } else if ($row['rank'] == 'OneMonth') {
                        $_SESSION['rang'] = 'Premium (1 Monat)';
                    } else if ($row['rank'] == 'Lifetime') {
                        $_SESSION['rang'] = 'Premium (Lifetime)';
                    }


                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}