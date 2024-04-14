<?php

namespace Controllers;

use Models\Order;
use Services\Orderservice;

class OrderController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new OrderService();
    }

    public function getAll()
    {
        $orders = $this->service->getAll();

        $this->respond($orders);
    }

    public function getOne($id)
    {
        $order = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the order is not found in the DB
        if (!$order) {
            $this->respondWithError(404, "Order not found");
            return;
        }

        $this->respond($order);
    }

    public function create()
    {
        try {
            $jsonData = file_get_contents('php://input');
            $orderData = json_decode($jsonData);

            $order = new Order();
            $order->user_id = $orderData->user->userID;
            $order->total = $orderData->basket->total;
            $order->payment_method = $orderData->payment->method;
            $order->created_at = date('Y-m-d H:i:s'); // Set current datetime for created_at
            $order->updated_at = date('Y-m-d H:i:s'); // Set current datetime for updated_at

            $order = $this->service->insert($order);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($order);
    }


    public function update($id)
    {
        try {
            $order = $this->createObjectFromPostedJson("Models\\Order");
            $order = $this->service->update($order, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
}