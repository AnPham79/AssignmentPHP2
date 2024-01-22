<?php
class CoreController
{
    protected $viewData = [];

    public function renderView($viewName, $viewData = [])
    {
        require '../app/Views/header__template.php';
        extract($viewData); // tách mảng , đối tượng thành biến
        require '../app/Views/' . $viewName . '.php';
        require '../app/Views/footer__template.php';
    }

    public function renderAdmin($viewName, $viewData = [])
    {
        extract($viewData); // tách mảng , đối tượng thành biến
        require '../app/Views/' . $viewName . '.php';
    }

    public function createModel($modelName)
    {
        return new ($modelName . "Model")();
    }
}

