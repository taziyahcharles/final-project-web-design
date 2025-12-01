<?php
$host = 'mysql-125f1ed0-taziyahcharles-c5cc.g.aivencloud.com';
$port = 12345;
$db   = 'adoption';
$user = 'avnadmin';
$pass = 'AVNS_0YEDaM4bT-koB69Fqv8';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
