<?php

namespace App\Core;


class View
{
    use Magic; //магические методы __set, __get

    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new \Twig\Environment($loader, ['cache' => false]);
    }

    public function display($page)
    {
        echo $this->twig->render($page, $this->data);
    }

    public function render($template)
    {
        ob_start();

        foreach ($this->data as $item => $value) {
            $$item = $value;
        }
        include $template;
        $html = ob_get_contents();
        ob_end_clean();
        echo $html;
    }

}