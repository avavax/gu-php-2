<?php
/**
 * Created by PhpStorm.
 * User: anatol
 * Date: 11.06.2019
 * Time: 22:18
 */

namespace App\services\renders;


class TwigRender implements IRender
{

    /**
     * @param $template
     * @param $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $params)
    {
        $loader = new \Twig\Loader\FilesystemLoader([
            $_SERVER['DOCUMENT_ROOT'] . "/../views/twig/",
            $_SERVER['DOCUMENT_ROOT'] . "/../views/",
        ]);
        $twig = new \Twig\Environment($loader);
        $template .= '.twig';
        return $twig->render($template, $params);
    }
}