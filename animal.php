<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config/db.php';
include 'includes/header.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    echo '<div class="alert alert-warning">Invalid animal ID</div>';
    include 'includes/footer.php';
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT * FROM animals WHERE id = ? AND status = "available"');
    $stmt->execute([$id]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$animal) {
        echo '<div class="alert alert-warning">Animal not found or no longer available</div>';
        include 'includes/footer.php';
        exit;
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Error loading animal information</div>';
    include 'includes/footer.php';
    exit;
}
?>

<div class="row mb-4">
    <div class="col-md-6">
        <?php if (!empty($animal['photo']) && file_exists($animal['photo'])): ?>
            <img src="<?= htmlspecialchars($animal['photo']) ?>" 
                 alt="<?= htmlspecialchars($animal['name']) ?>" 
                 class="img-fluid rounded shadow">
        <?php else: ?>
            <div class="bg-light rounded shadow d-flex align-items-center justify-content-center" 
                 style="height: 400px;">
                <span class="text-muted">Photo not available</span>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-md-6">
        <h1 class="mb-3"><?= htmlspecialchars($animal['name']) ?></h1>
        
        <div class="mb-4">
            <span class="badge bg-primary fs-6 mb-2"><?= htmlspecialchars($animal['species']) ?></span>
            <?php if (!empty($animal['breed'])): ?>
                <span class="badge bg-secondary fs-6 mb-2"><?= htmlspecialchars($animal['breed']) ?></span>
            <?php endif; ?>
        </div>
        
        <ul class="list-unstyled mb-4">
            <li class="mb-2"><strong>Age:</strong> <?= htmlspecialchars($animal['age']) ?> years</li>
            <li class="mb-2"><strong>Gender:</strong> <?= htmlspecialchars($animal['gender'] ?? 'Not specified') ?></li>
            <li class="mb-2"><strong>Size:</strong> <?= htmlspecialchars($animal['size'] ?? 'Not specified') ?></li>
            <li class="mb-2"><strong>Adoption Fee:</strong> $<?= htmlspecialchars($animal['fee'] ?? 'Contact for details') ?></li>
            <li><strong>Status:</strong> <span class="badge bg-success">Available for Adoption</span></li>
        </ul>
        
        <div class="mb-4">
            <h5>About <?= htmlspecialchars($animal['name']) ?></h5>
            <p class="lead"><?= nl2br(htmlspecialchars($animal['description'])) ?></p>
        </div>
        
        <?php if (!empty($animal['personality'])): ?>
            <div class="mb-4">
                <h5>Personality</h5>
                <p><?= nl2br(htmlspecialchars($animal['personality'])) ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($animal['special_needs'])): ?>
            <div class="mb-4">
                <h5>Special Needs</h5>
                <p><?= nl2br(htmlspecialchars($animal['special_needs'])) ?></p>
            </div>
        <?php endif; ?>
        
        <div class="d-grid gap-2 d-md-flex">
            <a class="btn btn-success btn-lg" href="contact.php?adopt=<?= $animal['id'] ?>">
                Apply to Adopt <?= htmlspecialchars($animal['name']) ?>
            </a>
            <a class="btn btn-outline-primary btn-lg" href="adopt.php">
                Back to All Animals
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>