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

<div class="row">
  <div class="col-md-8">
    <h2>Welcome to Pet Haven</h2>
    <p>Find a new friend — browse animals ready for adoption.</p>
  </div>

  <div class="col-md-4">
    <div class="card p-3">
      <h5>Your Account</h5>
      <p><strong><?=htmlspecialchars($_SESSION['user_name'])?></strong></p>
      <a href="adopt.php" class="btn btn-primary">Browse Pets</a>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
