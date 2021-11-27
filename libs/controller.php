<?php

require_once(UTILS . '/httpResponse.php');

abstract class Controller
{

    function __construct()
    {
    }

    function loadModel($model)
    {
        $url = MODELS . '/' . $model . 'Model.php';

        if (file_exists($url)) {
            require $url;
            $modelName = ucfirst($model) . 'Model';
            $this->model = new $modelName();
        }
    }

    //abstract classes
    public abstract function create();
    public abstract function getAll();
    public abstract function getById($id);
    public abstract function update($id);
    public abstract function delete($id);
}
