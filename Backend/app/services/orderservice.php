<?php

namespace Services;

use Repositories\OrderRepository;

class orderservice
{
    private $orderRepository;

    function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function getAll()
    {
        return $this->orderRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->orderRepository->getOne($id);
    }

    public function insert($order)
    {
        return $this->orderRepository->insert($order);
    }

    public function update($order, $id)
    {
        return $this->orderRepository->update($order, $id);
    }

    public function delete($id)
    {
        return $this->orderRepository->delete($id);
    }
}