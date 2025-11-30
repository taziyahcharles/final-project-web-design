<?php
session_start();
require 'includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Haven</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
</body>
</html>
<div class="row align-items-center mb-4">

  <div class="col-md-8">
      <h2 class="fw-bold">Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>! 🐾</h2>

      <p class="lead">
          We're so glad to have you here at <strong>Pet Haven</strong>, where every animal gets a second chance 
          and every adopter becomes a hero. Ready to meet your next furry best friend?
      </p>

      <a href="adopt.php" class="btn btn-lg btn-success mt-3">
        🐶 Browse Available Pets
      </a>
  </div>

  <div class="col-md-4">
      <div class="card shadow-sm p-3">
          <h5 class="fw-bold mb-2">Your Account</h5>
          <p class="mb-2">Logged in as:</p>
          <p class="fs-5"><strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p>

          <hr>

          <p>Need to update anything? View your profile or explore the adoption listings.</p>

          <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
      </div>
  </div>

</div>

<div class="alert alert-info mt-4 shadow-sm">
    🌟 <strong>Did you know?</strong> Every time you adopt, donate, or volunteer, you help give an animal a brighter future.
</div>

<?php include 'includes/footer.php'; ?>
