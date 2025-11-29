<?php
if (session_status() === PHP_SESSION_NONE) session_start();

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
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Pet Haven</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="adopt.php">Adopt</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>
        <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
        <li class="nav-item"><a class="nav-link" href="donate.php">Donate</a></li>
        <li class="nav-item"><a class="nav-link" href="volunteer.php">Volunteer</a></li>
        <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonials</a></li>
      </ul>

      <ul class="navbar-nav">
        <?php if($logged): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Hello, <?=htmlspecialchars($name)?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container py-5">

  <div class="text-center mb-5">
    <h1 class="display-4 fw-bold">Welcome to Pet Haven</h1>
    <p class="lead">Helping animals find loving homes.</p>
    
    <a href="adopt.php" class="btn btn-primary btn-lg">Browse Animals</a>
  </div>

  <!-- Featured Animals Section -->
  <h3 class="mb-4 text-center">Featured Pets</h3>

  <div class="row g-4">

    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/placeholder1.jpg" class="card-img-top" alt="Bella">
        <div class="card-body">
          <h5 class="card-title">Bella</h5>
          <p class="card-text">A friendly, playful companion looking for a forever home.</p>
          <a href="adopt.php" class="btn btn-outline-primary w-100">View More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/placeholder2.jpg" class="card-img-top" alt="Milo">
        <div class="card-body">
          <h5 class="card-title">Milo</h5>
          <p class="card-text">A gentle cuddle-lover who enjoys attention.</p>
          <a href="adopt.php" class="btn btn-outline-primary w-100">View More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/placeholder3.jpg" class="card-img-top" alt="Rocky">
        <div class="card-body">
          <h5 class="card-title">Rocky</h5>
          <p class="card-text">Energetic and fun—perfect for an active family.</p>
          <a href="adopt.php" class="btn btn-outline-primary w-100">View More</a>
        </div>
      </div>
    </div>

  </div>

</div>

<!-- FOOTER -->
<footer class="text-center py-3 bg-light mt-5">
  <p class="mb-0">&copy; <?=date("Y")?> Pet Haven. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
