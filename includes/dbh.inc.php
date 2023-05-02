<?php

$servername = "localhost";
$dbUsername = "yourDbUsername";
$dbPasswort = "yourDbPassword";
$dbName = "yourDbTableName";

$conn = mysqli_connect($servername, $dbUsername, $dbPasswort, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}