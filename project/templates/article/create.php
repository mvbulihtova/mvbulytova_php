<?php
$title = 'Create Article';
require dirname(__DIR__) . '/header.php';
?>

<div class="container mt-4">
    <h1>Create new article</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>/article/store" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>
