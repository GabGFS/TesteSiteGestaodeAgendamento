<?php

class Controller {
    protected $viewPath = __DIR__ . '/../views/';

    protected function render(string $view, array $data = []) {
        extract($data);
        $header = $this->viewPath . 'layout/header.php';
        $footer = $this->viewPath . 'layout/footer.php';
        $viewFile = $this->viewPath . 'pages/' . $view . '.php';

        if (file_exists($header)) include $header;
        if (file_exists($viewFile)) include $viewFile;
        else {
            http_response_code(404);
            if (file_exists($this->viewPath . 'pages/404.php')) include $this->viewPath . 'pages/404.php';
        }
        if (file_exists($footer)) include $footer;
    }
}