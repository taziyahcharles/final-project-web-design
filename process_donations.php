<?php
session_start();
include 'includes/db.php'; // make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id'] ?? null;
    $donor_name = $_POST['donor_name'] ?? null;
    $donor_email = $_POST['donor_email'] ?? null;
    $amount = $_POST['amount'];

    // Validate amount
    if (!is_numeric($amount) || $amount <= 0) {
        die("Invalid donation amount.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("
        INSERT INTO donations (user_id, donor_name, donor_email, amount)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("issd", $user_id, $donor_name, $donor_email, $amount);

    if ($stmt->execute()) {
        header("Location: donate.php?success=1");
        exit;
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: donate.php");
    exit;
}
