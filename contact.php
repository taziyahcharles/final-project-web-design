<?php
require 'config/db.php';

$msg = '';
$adopt_id = intval($_GET['adopt'] ?? 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $animal = intval($_POST['animal_id'] ?? 0);
    if ($animal === 0) $animal = null;


    if ($name && $email && $message) {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages (name, email, message, animal_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $email, $message, $animal]);
            $msg = 'Message sent. Thank you!';
        } catch (PDOException $e) {
            $msg = 'Error sending message: ' . $e->getMessage();
        }
    } else {
        $msg = 'Please fill all fields';
    }
}

// Fetch animals for dropdown
$animals = $pdo->query('SELECT id, name FROM animals')->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<h2>Contact / Adoption Application</h2>

<?php if ($msg): ?>
    <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<form method="post">
    <input 
        name="name" 
        class="form-control mb-2" 
        placeholder="Your name" 
        required 
        value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>"
    >
    
    <input 
        name="email" 
        type="email" 
        class="form-control mb-2" 
        placeholder="Email" 
        required
    >
    
    <select name="animal_id" class="form-select mb-2">
        <option value="0">General inquiry</option>
        <?php foreach ($animals as $an): ?>
            <option value="<?= $an['id'] ?>" <?= $adopt_id == $an['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($an['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <textarea 
        name="message" 
        class="form-control mb-2" 
        placeholder="Your message" 
        rows="4" 
        required
    ></textarea>
    
    <button class="btn btn-primary">Send</button>
</form>

<?php include 'includes/footer.php'; ?>
