<?php
$title = 'Edit comment';
require dirname(__DIR__) . '/header.php';
?>

<div class="container mt-4">
    <h2>Edit comment</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="/comment/<?= $comment->getId(); ?>/update" method="POST">
        <textarea name="text" required class="form-control" rows="4"><?= htmlspecialchars($comment->getText()); ?></textarea>
        <button type="submit" class="btn btn-success mt-2">Сохранить</button>
    </form>
</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>