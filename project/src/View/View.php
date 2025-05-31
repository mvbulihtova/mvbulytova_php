<?php

namespace src\View;

class View
{
    private string $templatesPath;

    public function __construct(string $templatesPath = null)
    {
        $this->templatesPath = dirname(__DIR__, 2) . '/templates';
    }

    public function renderHtml(string $templateName, array $vars = [], int $code = 200): void
    {
        http_response_code($code);

        extract($vars);
        $templateFile = $this->templatesPath . '/' . $templateName . '.php';

        if (!file_exists($templateFile)) {
            echo "Template not found: " . htmlspecialchars($templateFile);
            return;
        }

        include $templateFile;
    }
}
