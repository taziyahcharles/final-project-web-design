<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config/db.php';

$msg = '';
$msg_type = '';
$adopt_id = intval($_GET['adopt'] ?? 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $animal_id = intval($_POST['animal_id'] ?? 0);
    if ($animal_id === 0) {
        $animal_id = null;
    }

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        $msg = 'Please fill all required fields';
        $msg_type = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please enter a valid email address';
        $msg_type = 'danger';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages (name, email, message, animal_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $email, $message, $animal_id]);
            $msg = 'Thank you! Your message has been sent. We\'ll get back to you soon.';
            $msg_type = 'success';
            
            // Clear form
            $_POST = [];
        } catch (PDOException $e) {
            $msg = 'Sorry, there was an error sending your message. Please try again.';
            $msg_type = 'danger';
        }
    }
}

// Fetch animals for dropdown
try {
    $animals = $pdo->query('SELECT id, name FROM animals ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $animals = [];
}

include 'includes/header.php';
?>

<h2 class="mb-4">Contact Us / Adoption Application</h2>

<div class="row">
    <div class="col-md-8">
        <?php if ($msg): ?>
            <div class="alert alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input name="name" class="form-control" 
                               value="<?= htmlspecialchars($_POST['name'] ?? ($_SESSION['user_name'] ?? '')) ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address *</label>
                        <input name="email" type="email" class="form-control" 
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Regarding Animal (Optional)</label>
                        <select name="animal_id" class="form-select">
                            <option value="0">General Inquiry</option>
                            <option value="volunteer">Volunteer Inquiry</option>
                            <option value="donation">Donation Inquiry</option>
                            <option value="event">Event Information</option>
                            <option value="support">Website Support</option>
                            <option value="other">Other Inquiry</option>
                            <?php foreach ($animals as $animal): ?>
                                <option value="<?= $animal['id'] ?>" 
                                <?= ($adopt_id == $animal['id'] || ($_POST['animal_id'] ?? 0) == $animal['id']) ? 'selected' : '' ?>>
                                Adoption: <?= htmlspecialchars($animal['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Your Message *</label>
                        <textarea name="message" class="form-control" rows="5" 
                                  required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Contact Information</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">📧 Email: info@pethaven.org</li>
                    <li class="mb-2">📞 Phone: (473) 414-7845</li>
                    <li class="mb-2">🏢 Address: Lothers Lane, St. George's, Grenada</li>
                    <li>⏰ Hours: Mon-Fri 9am-6pm, Sat 10am-4pm</li>
                </ul>
                
                <hr>
                
                <h6>Adoption Process</h6>
                <ol class="small">
                    <li>Submit application/contact form</li>
                    <li>Phone interview</li>
                    <li>Home visit (if required)</li>
                    <li>Meet & greet with animal</li>
                    <li>Finalize adoption</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>