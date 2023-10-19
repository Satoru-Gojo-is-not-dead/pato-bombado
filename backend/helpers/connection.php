<?php

$host = "localhost";
$dbName = "apatolipse";
$userName = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
}
