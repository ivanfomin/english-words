<?php
/**
 * Created by PhpStorm.
 * User: ioan
 * Date: 26.11.16
 * Time: 17:59
 */

namespace App\Core;


class View
{
    use Magic; //магические методы __set, __get

    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
        $this->twig = new \Twig_Environment($loader, ['cache' => false]);
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