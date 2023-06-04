<?php
$host = 'localhost';
$db   = 'bingo_database';
$user = 'root';
$pass = 'bH*6V)UVjI7cuc/O';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
