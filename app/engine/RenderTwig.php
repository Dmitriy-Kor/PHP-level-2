<?php
namespace app\engine;

use app\interfaces\IRenderer;

class RenderTwig implements IRenderer
{
    
    public function renderTemplate($template, $params = [])
    {
        $templatePath = TEMPLATE_TWIG_DIR . $template . ".twig";
        var_dump($templatePath);
        var_dump($params);
        require_once '../vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('../twigTemplates');
        $twig = new \Twig\Environment($loader, [
        'cache' => '../twigTemplates/cache']);
        return $twig->render($templatePath, $params);

    }
    
}

