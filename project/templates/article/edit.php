<?php require dirname(__DIR__) . '/header.php'; ?>

<h3>Редактировать статью</h3>

<form action="<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>/article/store" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" value="<?= htmlspecialchars($article->getName()); ?>" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea class="form-control" id="text" name="text" rows="5" required><?= htmlspecialchars($article->getText()); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php require dirname(__DIR__) . '/footer.php'; ?>
