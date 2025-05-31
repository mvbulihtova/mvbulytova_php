<?php require dirname(__DIR__) . '/header.php'; ?>

<h2><?= htmlspecialchars($article->getName()); ?></h2>
<p class="text-muted">Автор: <?= htmlspecialchars($article->getAuthor()->getNickname()); ?></p>
<div class="mb-4"><?= nl2br(htmlspecialchars($article->getText())); ?></div>
<a href="php/mvbulytova_php/project/www/article/<?= $article->getId(); ?>/edit" class="ms-2">Редактировать</a>
<a href="php/mvbulytova_php/project/www/article/<?= $article->getId(); ?>/delete" class="ms-2">Del</a>


<hr>

<h4>Комментарии</h4>

<?php if (empty($comments)): ?>
    <p class="text-muted">Пока нет комментариев.</p>
<?php else: ?>
    <?php foreach ($comments as $comment): ?>
        <div class="border rounded p-2 mb-2" id="comment<?= $comment->getId(); ?>">
            <p><?= nl2br(htmlspecialchars($comment->getText())); ?></p>
            <small class="text-muted">
                Автор: <?= htmlspecialchars($comment->getAuthor()->getNickname()); ?> |
                <?= $comment->getCreatedAt(); ?>
                <a href="/comment/<?= $comment->getId(); ?>/edit" class="ms-2">Редактировать</a>
            </small>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr>

<h4>Добавить комментарий</h4>
<form action="/php/mvbulytova_php/project/www/article/<?= $article->getId(); ?>/comment/store" method="POST">
    <div class="mb-3">
        <textarea name="text" class="form-control" rows="3" placeholder="Ваш комментарий..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<?php require dirname(__DIR__) . '/footer.php'; ?>
