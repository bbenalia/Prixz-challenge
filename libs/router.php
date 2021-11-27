<?php

require_once(UTILS . '/httpResponse.php');

class Router
{
    protected $uri;
    protected $controller;
    protected $method;
    protected $param;

    function __construct()
    {
        $this->setUri();
        $this->setController();
        $this->setMethod();
        $this->setParam();

        $this->loadUriRequest();
    }

    function setUri()
    {
        $url = rtrim($_SERVER['REQUEST_URI'], '/');
        $this->uri = explode("/", $url);
    }

    function setController()
    {
        $this->controller = isset($this->uri[2]) ? $this->uri[2] : '';
    }

    function setMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $this->method = isset($method) ? $method : '';
    }

    function setParam()
    {
        $this->param = isset($this->uri[3]) ? $this->uri[3] : '';
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function loadUriRequest()
    {
        // There is no controller
        if (empty($this->controller)) {
            $error = new HttpResponse(["message" => 'Error loading controller'], 400);
            $error->Json();
            return;
        }

        try {
            $fileController = CONTROLLERS . '/' . $this->controller . 'Controller.php';
            $classController =  ucfirst($this->controller) . 'Controller';
            require_once($fileController);

            $controller = new $classController;
            $controller->loadModel($this->controller);

            switch ($this->method) {
                case 'GET':
                    if ($this->param)
                        $controller->getById($this->param);
                    else
                        $controller->getAll();
                    break;

                case 'POST':
                    $controller->create();
                    break;

                case 'PATCH':
                    $controller->update($this->param);
                    break;

                case 'DELETE':
                    $controller->delete($this->param);
                    break;

                default:
                    $error = new HttpResponse(
                        ["message" => "Available methods: GET, POST, PATCH, DELETE"],
                        400
                    );
                    $error->Json();
                    break;
            }
        } catch (Throwable $th) {
            $error = new HttpResponse(["message" => $th->getMessage()], 500);
            $error->Json();
        }
    }
}
