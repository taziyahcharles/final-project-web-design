<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$logged = isset($_SESSION['user_id']);
$name = $_SESSION['user_name'] ?? 'Guest';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pet Haven - Animal Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Pet Haven</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="adopt.php">Adopt</a></li>
        <li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>
        <!-- Resources page removed -->
        <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonials</a></li>
        <li class="nav-item"><a class="nav-link" href="donate.php">Donate</a></li>
        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>

      <ul class="navbar-nav">
        <?php if($logged): ?>
          <li class="nav-item"><a class="nav-link">Hello, <?=htmlspecialchars($name)?></a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>

<div class="container py-4">
