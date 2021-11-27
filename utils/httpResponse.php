<?php

class httpResponse
{

    function __construct($data, int $statusCode)
    {
        $this->response = $data;
        $this->statusCode = $statusCode;
    }

    public function Json()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Methods: POST');
        echo json_encode($this->response);
        http_response_code($this->statusCode);
    }
}
