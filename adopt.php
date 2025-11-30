<?php
include 'includes/header.php';

// Hardcoded pets (not from database)
$animals = [
    [
        'name' => 'Luna',
        'species' => 'Dog',
        'age' => 2,
        'photo' => 'images/2yearoldhusky.jpg',
        'description' => 'Very friendly husky who loves attention, belly rubs, and long walks.'
    ],
    [
        'name' => 'Milo',
        'species' => 'Cat',
        'age' => 1,
        'photo' => 'images/Orangecat.jpg',
        'description' => 'A playful orange tabby who loves chasing toys and napping in sunny spots.'
    ],
    [
        'name' => 'Coco',
        'species' => 'Rabbit',
        'age' => 1,
        'photo' => 'images/tinyrabbit.jpg',
        'description' => 'A tiny energetic bunny who loves carrots and hopping around the yard.'
    ],
    [
        'name' => 'Rocky',
        'species' => 'Dog',
        'age' => 5,
        'photo' => 'images/germanshepard.jpg',
        'description' => 'Loyal German Shepherd, very intelligent and protective.'
    ],
    [
        'name' => 'Peanut',
        'species' => 'Guinea Pig',
        'age' => 1,
        'photo' => 'images/pigginuea.jpg',
        'description' => 'Small, squeaky, and adorable. Loves fresh veggies and tunnels.'
    ],
    [
        'name' => 'Max',
        'species' => 'Dog',
        'age' => 1,
        'photo' => 'images/smalldawg.jpg',
        'description' => 'High-energy pup who loves fetch, running, and being outdoors.'
    ],
    [
        'name' => 'Willow',
        'species' => 'Cat',
        'age' => 3,
        'photo' => 'images/longcat.jpg',
        'description' => 'Elegant long-haired cat who enjoys quiet spaces and gentle brushing.'
    ],
];
?>

<h2>Animals for Adoption</h2>
<div class="row">

<?php foreach($animals as $a): ?>
  <div class="col-md-4 mb-3">
    <div class="card">
      <img src="<?= htmlspecialchars($a['photo']) ?>" class="card-img-top" alt="<?= htmlspecialchars($a['name']) ?>">

      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($a['name']) ?></h5>
        <p class="card-text">
            <strong>Species:</strong> <?= htmlspecialchars($a['species']) ?><br>
            <strong>Age:</strong> <?= htmlspecialchars($a['age']) ?> years<br><br>
            <?= htmlspecialchars($a['description']) ?>
        </p>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>

<?php include 'includes/footer.php'; ?>
