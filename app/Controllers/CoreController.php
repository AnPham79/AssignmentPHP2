<?php
class CoreController
{
    protected $viewData = [];

    public function renderView($viewName, $viewData = [])
    {
        extract($viewData); // tách mảng , đối tượng thành biến
        require '../app/Views/' . $viewName . '.php';
    }

    public function createModel($modelName)
    {
        return new ($modelName . "Model")();
    }
}

