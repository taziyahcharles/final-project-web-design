<?php 
include 'config/db.php'; 
include 'includes/header.php'; 
?>

<div class="container py-4">

    <h2 class="mb-4 text-center">Support Pet Haven</h2>

    <p class="lead text-center" style="max-width: 700px; margin: 0 auto;">
        Your donation helps us provide food, shelter, medical care, and love to animals in need.
        Every contribution big or small makes a difference.
    </p>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success mt-4 text-center">
            Thank you for your donation!
        </div>
    <?php endif; ?>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">One-Time Donation</h4>
                    <form action="process_donations.php" method="POST">
                        <!-- Donor Name -->
                        <label class="form-label">Your Name</label>
                        <input type="text" name="donor_name" class="form-control mb-3" 
                               value="<?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : '' ?>" 
                               required>

                        <!-- Donor Email -->
                        <label class="form-label">Your Email</label>
                        <input type="email" name="donor_email" class="form-control mb-3" required>

                        <!-- Donation Amount -->
                        <label class="form-label">Donation Amount (USD)</label>
                        <input type="number" name="amount" class="form-control mb-3" min="1" required>

                        <button class="btn btn-primary w-100">Donate Now</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <h5>Other Ways to Help</h5>
                <p>You can also donate supplies, food, toys, or volunteer your time at the shelter.</p>
            </div>

        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
