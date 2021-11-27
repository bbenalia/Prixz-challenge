<?php

class OrdersController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $this->model->create($data);

            $res = new HttpResponse(['message' => 'Order created successfully!'], 200);
            $res->Json();
        } catch (Throwable $th) {
            $res = new HttpResponse(['message' => $th->getMessage()], 500);
            $res->Json();
        }
    }

    public function getAll()
    {
        try {
            $ordersList = $this->model->getAll();
            $res = new HttpResponse(['data' => $ordersList], 200);
            $res->Json();
        } catch (Throwable $th) {
            $res = new HttpResponse(['message' => $th->getMessage()], 500);
            $res->Json();
        }
    }

    public function getById($id)
    {
        try {
            $order = $this->model->getById($id);
            $res = new HttpResponse(['data' => $order], 200);
            $res->Json();
        } catch (Throwable $th) {
            $res = new HttpResponse(['message' => $th->getMessage()], 500);
            $res->Json();
        }
    }

    public function update($id)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $this->model->update($data, $id);

            $res = new HttpResponse(["message" => "Order updated successfully!"], 200);
            $res->Json();
        } catch (Throwable $th) {
            $res = new HttpResponse(['message' => $th->getMessage()], 500);
            $res->Json();
        }
    }

    public function delete($id)
    {
        try {
            $this->model->delete($id);

            $res = new HttpResponse(["message" => "Order deleted successfully!"], 200);
            $res->Json();
        } catch (Throwable $th) {
            $res = new HttpResponse(['message' => $th->getMessage()], 500);
            $res->Json();
        }
    }
}
