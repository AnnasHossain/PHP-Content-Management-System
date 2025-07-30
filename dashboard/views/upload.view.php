<h3>Status vom Upload:</h3>
<?php if(empty($message)): ?>
    <p>Alles okay!</p>
<?php else: ?>
    <p><?php echo e($message); ?></p>
<?php endif; ?>

<a href="dashboard.php">Zurück zur Übersicht</a>