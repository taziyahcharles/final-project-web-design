<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 
?>

<h2>Upcoming Events</h2>

<?php
// Fetch events from the database
$events = $pdo->query('SELECT id, title, description, event_date FROM events ORDER BY event_date ASC')->fetchAll(PDO::FETCH_ASSOC);

if ($events):
?>
    <ul class="list-group mb-4">
        <?php foreach ($events as $event): ?>
            <li class="list-group-item">
                <h5><?= htmlspecialchars($event['title']) ?></h5>
                <p><?= htmlspecialchars($event['description']) ?></p>
                <small class="text-muted">Date: <?= date('F j, Y', strtotime($event['event_date'])) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No upcoming events at the moment. Please check back later!</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
