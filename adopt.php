<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';
include 'includes/header.php';

try {
    // Fetch animals from database
    $stmt = $pdo->query('SELECT * FROM animals WHERE status = "available" ORDER BY name');
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // If no animals in database, use fallback data
    if (empty($animals)) {
        $animals = [
            [
                'id' => 1,
                'name' => 'Luna',
                'species' => 'Dog',
                'breed' => 'Husky',
                'age' => 2,
                'photo' => 'images/2yearoldhusky.jpg',
                'description' => 'Very friendly husky who loves attention, belly rubs, and long walks.'
            ],
            [
                'id' => 2,
                'name' => 'Milo',
                'species' => 'Cat',
                'breed' => 'Orange Tabby',
                'age' => 1,
                'photo' => 'images/Orangecat.jpg',
                'description' => 'A playful orange tabby who loves chasing toys and napping in sunny spots.'
            ],
            // Add more fallback animals as needed
        ];
    }
} catch (PDOException $e) {
    // If database error, use hardcoded data
    $animals = [
        [
            'id' => 1,
            'name' => 'Luna',
            'species' => 'Dog',
            'breed' => 'Husky',
            'age' => 2,
            'photo' => 'images/2yearoldhusky.jpg',
            'description' => 'Very friendly husky who loves attention, belly rubs, and long walks.'
        ],
        [
            'id' => 2,
            'name' => 'Milo',
            'species' => 'Cat',
            'breed' => 'Orange Tabby',
            'age' => 1,
            'photo' => 'images/Orangecat.jpg',
            'description' => 'A playful orange tabby who loves chasing toys and napping in sunny spots.'
        ],
    ];
}
?>

<h2 class="mb-4">Animals Available for Adoption</h2>

<?php if (empty($animals)): ?>
    <div class="alert alert-info">
        <p>No animals are currently available for adoption. Please check back soon!</p>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach($animals as $animal): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($animal['photo']) && file_exists($animal['photo'])): ?>
                        <img src="<?= htmlspecialchars($animal['photo']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($animal['name']) ?>"
                             style="height: 250px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 250px;">
                            <span class="text-muted">No photo available</span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($animal['name']) ?></h5>
                        <p class="card-text">
                            <strong>Species:</strong> <?= htmlspecialchars($animal['species']) ?><br>
                            <?php if (!empty($animal['breed'])): ?>
                                <strong>Breed:</strong> <?= htmlspecialchars($animal['breed']) ?><br>
                            <?php endif; ?>
                            <strong>Age:</strong> <?= htmlspecialchars($animal['age']) ?> years
                        </p>
                        <p class="card-text flex-grow-1">
                            <?= htmlspecialchars($animal['description']) ?>
                        </p>
                        <div class="mt-auto">
                            <a href="contact.php?adopt=<?= $animal['id'] ?>" 
                               class="btn btn-success w-100">
                               Apply to Adopt <?= htmlspecialchars($animal['name']) ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>