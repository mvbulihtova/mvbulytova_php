<?php
$title = $title ?? 'Мой блог';
require dirname(__DIR__) . '/header.php';
?>

<h1 class="mb-4">Мой блог</h1>

<?php if (empty($articles)): ?>
    <div class="alert alert-warning">Нет статей для отображения.</div>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Text</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article->getId(); ?></td>
                    <td>
                        <a href="/php/mvbulytova_php/project/www/article/<?= $article->getId(); ?>">
                          <?= htmlspecialchars($article->getName()); ?>
                        </a>
                    </td>
                    <td><?= nl2br(htmlspecialchars($article->getText())); ?></td>
                    <td><?= htmlspecialchars($article->getAuthor()->getNickname()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require dirname(__DIR__) . '/footer.php'; ?>
