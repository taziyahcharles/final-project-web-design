<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
            Thank you for your generous donation! Your support helps save animal lives.
        </div>
    <?php endif; ?>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Make a Donation</h4>
                    <form action="process_donations.php" method="POST">
                        <!-- Donor Name -->
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="donor_name" class="form-control" 
                                   value="<?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : '' ?>" 
                                   required>
                        </div>

                        <!-- Donor Email -->
                        <div class="mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="donor_email" class="form-control" 
                                   value="<?= isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '' ?>" 
                                   required>
                        </div>

                        <!-- Donation Amount -->
                        <div class="mb-3">
                            <label class="form-label">Donation Amount (USD)</label>
                            <div class="row">
                                <div class="col-6">
                                    <select name="amount" class="form-select" id="amountSelect">
                                        <option value="">Select or enter amount</option>
                                        <option value="10">$10</option>
                                        <option value="25">$25</option>
                                        <option value="50">$50</option>
                                        <option value="100">$100</option>
                                        <option value="250">$250</option>
                                        <option value="500">$500</option>
                                        <option value="custom">Custom Amount</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="number" name="custom_amount" class="form-control" id="customAmount" 
                                           placeholder="Enter custom amount" min="1" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <!-- Message (Optional) -->
                        <div class="mb-3">
                            <label class="form-label">Message (Optional)</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Add a message with your donation"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">Donate Now</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountSelect = document.getElementById('amountSelect');
    const customAmount = document.getElementById('customAmount');
    
    amountSelect.addEventListener('change', function() {
        if (this.value === 'custom') {
            customAmount.style.display = 'block';
            customAmount.required = true;
            customAmount.focus();
        } else {
            customAmount.style.display = 'none';
            customAmount.required = false;
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>