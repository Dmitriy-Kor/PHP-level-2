<?php

namespace app\controllers;

use app\interfaces\IRenderer;

abstract class Controller
{

    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = false;
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        var_dump($method);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die('Экшен не существует');
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', $params),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []){
        return $this->renderer->renderTemplate($template, $params);
    }
}
