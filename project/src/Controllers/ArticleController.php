<?php

namespace src\Controllers;

use src\Models\Articles\Article;
use src\Models\Users\User;
use src\Models\Comment\Comment;
use src\View\View;

class ArticleController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(dirname(__DIR__) . '/templates');
    }

    // Главная страница со списком статей
    public function index(): void
    {
        $articles = Article::findAll();

        $this->view->renderHtml('main/main', [
            'articles' => $articles,
            'title' => 'Мой блог'
        ]);
    }

    // Показ конкретной статьи и комментариев
    public function show(int $id): void
    {
        $article = Article::getById($id);

        if ($article === null) {
            $this->view->renderHtml('main/error', [], 404);
            return;
        }

        $comments = Comment::findByColumn('article_id', $id);

        $this->view->renderHtml('article/show', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    // Форма создания статьи
    public function create(): void
    {
        $this->view->renderHtml('article/create', [
            'title' => 'Создать статью'
        ]);
    }

    // Сохранение новой статьи
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /php/mvbulytova_php/project/www/article/create');
            exit();
        }

        if (empty($_POST['name']) || empty($_POST['text'])) {
            $this->view->renderHtml('article/create', [
                'error' => 'Пожалуйста, заполните все поля.'
            ]);
            return;
        }

        try {
            $article = new Article();
            $article->setName($_POST['name']);
            $article->setText($_POST['text']);
            $article->setAuthorId(1); // временно статично
            $article->save();

            header('Location: /php/mvbulytova_php/project/www/article/' . $article->getId());
        } catch (\Exception $e) {
            $this->view->renderHtml('article/create', [
                'error' => 'Ошибка при сохранении: ' . $e->getMessage()
            ]);
        }
    }

    // Форма редактирования статьи
    public function edit(int $id): void
    {
        $article = Article::getById($id);

        if ($article === null) {
            $this->view->renderHtml('main/error', [], 404);
            return;
        }

        $this->view->renderHtml('article/edit', [
            'article' => $article
        ]);
    }

    // Обновление статьи
    public function update(int $id): void
    {
        $article = Article::getById($id);

        if ($article === null) {
            $this->view->renderHtml('main/error', [], 404);
            return;
        }

        $article->setName($_POST['name']);
        $article->setText($_POST['text']);
        $article->save();

        header('Location: /article/' . $article->getId());
    }

    // Удаление статьи
    public function delete(int $id): void
    {
        $article = Article::getById($id);

        if ($article === null) {
            $this->view->renderHtml('main/error', [], 404);
            return;
        }

        $article->delete();
        header('Location: /php/mvbulytova_php/project/www/');
    }
}
