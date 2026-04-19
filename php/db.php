<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "127.0.0.1";
$db   = "ecommerce";
$user = "root";
$pass = "";
$port = 3307;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}

function isLogged() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLogged()) {
        header("Location: ../php/login.php");
        exit;
    }
}

?>
