<?php
namespace app\engine;

use app\interfaces\IRenderer;

class RenderTwig implements IRenderer
{
    protected $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_TWIG_DIR);
        // $this->twig = new \Twig\Environment($loader, [
        // 'cache' => '../twigTemplates/cache']);
        $this->twig = new \Twig\Environment($loader);
        
    }


    public function renderTemplate($template, $params = [])
    {
        $templatePath = $template . ".twig";
        // var_dump($templatePath);
        // var_dump($params);
        return $this->twig->render($templatePath, $params);

    }
    
}
