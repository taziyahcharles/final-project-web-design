<?php
require 'includes/db.php';
include 'includes/header.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM animals WHERE id = ?');
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$a) { echo '<div class="alert alert-warning">Animal not found</div>'; include 'includes/footer.php'; exit; }
?>
<div class="row">
  <div class="col-md-5"><img src="<?=htmlspecialchars($a['photo'])?>" alt="<?=htmlspecialchars($a['name'])?>" class="img-fluid rounded"></div>
  <div class="col-md-7">
    <h2><?=htmlspecialchars($a['name'])?></h2>
    <p><strong>Species:</strong> <?=htmlspecialchars($a['species'])?></p>
    <p><strong>Age:</strong> <?=htmlspecialchars($a['age'])?> years</p>
    <p><?=nl2br(htmlspecialchars($a['description']))?></p>
    <a class="btn btn-success" href="contact.php?adopt=<?=$a['id']?>">Apply to Adopt</a>
  </div>
</div>
<?php include 'includes/footer.php'; ?>