<?php

require_once(MODELS . '/entities/product.php');
require_once(MODELS . '/entities/productList.php');

class OrdersModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function create($order)
    {
        try {
            return $this->woo->connect()->post('orders', $order);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            return $this->woo->connect()->get('orders');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            return $this->woo->connect()->get("orders/$id");
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($order, $id)
    {
        try {
            return $this->woo->connect()->put("orders/$id", $order);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->woo->connect()->delete("orders/$id", ['force' => true]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
