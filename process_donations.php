<?php
session_start();
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_SESSION['user_id'] ?? null;
    $donor_name = trim($_POST['donor_name'] ?? '');
    $donor_email = trim($_POST['donor_email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Determine amount
    $amount = 0;
    if (isset($_POST['amount']) && $_POST['amount'] !== 'custom') {
        $amount = floatval($_POST['amount']);
    } elseif (isset($_POST['custom_amount']) && !empty($_POST['custom_amount'])) {
        $amount = floatval($_POST['custom_amount']);
    }
    
    // Validate inputs
    $errors = [];
    
    if (empty($donor_name)) {
        $errors[] = "Please enter your name";
    }
    
    if (empty($donor_email) || !filter_var($donor_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if ($amount <= 0) {
        $errors[] = "Please enter a valid donation amount";
    }
    
    // If no errors, process donation
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO donations (user_id, donor_name, donor_email, amount, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $donor_name, $donor_email, $amount, $message]);
            
            header("Location: donate.php?success=1");
            exit;
        } catch (PDOException $e) {
            die("Error processing donation: " . $e->getMessage());
        }
    } else {
        // Store errors in session and redirect back
        $_SESSION['donation_errors'] = $errors;
        $_SESSION['donation_form'] = $_POST;
        header("Location: donate.php");
        exit;
    }
} else {
    header("Location: donate.php");
    exit;
}
?>