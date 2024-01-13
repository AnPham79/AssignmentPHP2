<?php

class Core
{
    protected $controller = 'page';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $url = explode("/", $_GET['url']);
            $this->controller = $url[0];
            unset($url[0]);
            $this->method = $url[1];
            unset($url[1]);
            $this->params = array_values($url);
        }

        spl_autoload_register(function ($class) {
            $CONTROLLERS_PATH = '../app/controllers/' . $class . '.php';
            $MODELS_PATH = '../app/Models/' . $class . '.php';
            $VIEWS_PATH = '../app/lib/' . $class . '.php';

            if (file_exists($CONTROLLERS_PATH)) {
                require $CONTROLLERS_PATH;
            } elseif (file_exists($MODELS_PATH)) {
                require $MODELS_PATH;
            } elseif (file_exists($VIEWS_PATH)) {
                require $VIEWS_PATH;
            }
        });
        $class = new ($this->controller . 'controller')();
        call_user_func_array([$class, $this->method], $this->params);
    }
}
