<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
?>

<div class="container mt-5">

    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">
                Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>! 🐾
            </h2>

            <p class="lead">
                We're so glad to have you here at <strong>Pet Haven</strong>, where every animal
                gets a second chance and every adopter becomes a hero. Ready to meet your next
                furry best friend?
            </p>

            <a href="adopt.php" class="btn btn-lg btn-success mt-3">
                🐶 Browse Available Pets
            </a>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-2">Your Account</h5>

                <p class="mb-2">Logged in as:</p>
                <p class="fs-5">
                    <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>
                </p>

                <hr>

                <p>Need to update anything? View your profile or explore the adoption listings.</p>

                <div class="d-grid gap-2">
                    <a href="adopt.php" class="btn btn-outline-primary">View Pets</a>
                    <a href="donate.php" class="btn btn-outline-success">Make a Donation</a>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info mt-4 shadow-sm">
        🌟 <strong>Did you know?</strong> Every time you adopt, donate, or volunteer, you help give an
        animal a brighter future.
    </div>

    <div class="row mt-5">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🐕 Adopt a Pet</h5>
                    <p class="card-text">Find your perfect companion from our loving animals waiting for homes.</p>
                    <a href="adopt.php" class="btn btn-primary">Browse Animals</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">💰 Make a Donation</h5>
                    <p class="card-text">Support our mission to care for homeless animals.</p>
                    <a href="donate.php" class="btn btn-success">Donate Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📅 Upcoming Events</h5>
                    <p class="card-text">Join our community events and meet other pet lovers.</p>
                    <a href="events.php" class="btn btn-info text-white">View Events</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>