<?php
require 'includes/db.php';
include 'includes/header.php';
$stmt = $pdo->query('SELECT id, name, species, age, photo FROM animals ORDER BY id');
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Animals for Adoption</h2>
<div class="row">
<?php foreach($animals as $a): ?>
  <div class="col-md-4 mb-3">
    <div class="card">
      <img src="<?=htmlspecialchars($a['photo'])?>" class="card-img-top" alt="<?=htmlspecialchars($a['name'])?>">
      <div class="card-body">
        <h5 class="card-title"><?=htmlspecialchars($a['name'])?></h5>
        <p class="card-text"><?=htmlspecialchars($a['species'])?> • <?=htmlspecialchars($a['age'])?> yrs</p>
        <a href="animal.php?id=<?=$a['id']?>" class="btn btn-outline-primary btn-sm">View</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>