<?php
require 'config/db.php';
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: login.php'); exit;
}
include 'includes/header.php';
$stmt = $pdo->query('SELECT m.*, a.name as animal FROM messages m LEFT JOIN animals a ON a.id = m.animal_id ORDER BY created_at DESC');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Messages</h2>
<table class="table table-striped">
  <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Animal</th><th>Message</th><th>When</th></tr></thead>
  <tbody>
    <?php foreach($messages as $m): ?>
      <tr>
        <td><?=htmlspecialchars($m['id'])?></td>
        <td><?=htmlspecialchars($m['name'])?></td>
        <td><?=htmlspecialchars($m['email'])?></td>
        <td><?=htmlspecialchars($m['animal'] ?? '—')?></td>
        <td><?=nl2br(htmlspecialchars($m['message']))?></td>
        <td><?=htmlspecialchars($m['created_at'])?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include 'includes/footer.php'; ?>