<?php

namespace src\Controllers;

use src\Models\Comment\Comment;
use src\View\View;

class CommentController
{
    private View $view;

    public function __construct() {
        $this->view = new View(dirname(__DIR__) . '/templates');
    }

    public function store(int $articleId): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $comment = new Comment();
        $comment->setText($_POST['text']);
        $comment->setAuthorId(1); // Временно статично
        $comment->setArticleId($articleId);
        $comment->save();

        $id = $comment->getId();
        header("Location: /php/mvbulytova_php/project/www/article/{$articleId}#comment{$id}");
    }

    public function edit(int $commentId): void {
        $comment = Comment::getById($commentId);
        $this->view->renderHtml('comment/edit', ['comment' => $comment]);
    }

    public function update(int $commentId): void {
        $comment = Comment::getById($commentId);
        $comment->setText($_POST['text']);
        $comment->save();

        header("Location: /php/mvbulytova_php/project/www/article/" . $comment->articleId . "#comment" . $comment->getId());
    }
}
