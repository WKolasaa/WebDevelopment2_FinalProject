<?php

namespace Repositories;


use models\order;

class OrderRepository extends Repository
{
    function getAll()
    {
        try {
            $query = "SELECT * FROM orders";

            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            $orders = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                $orders[] = $this->rowToOrder($row);
            }

            return $orders;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $query = "SELECT * FROM orders WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $order = $this->rowToOrder($row);

            return $order;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($order)
    {
        try {
            $query = "INSERT INTO orders (user_id, total, payment_method, created_at, updated_at) 
                      VALUES (:user_id, :total, :payment_method, :created_at, :updated_at)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':user_id', $order->user_id);
            $stmt->bindParam(':total', $order->total);
            $stmt->bindParam(':payment_method', $order->payment_method);
            $stmt->bindParam(':created_at', $order->created_at);
            $stmt->bindParam(':updated_at', $order->updated_at);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function update($order, $id)
    {
        try {
            $query = "UPDATE orders SET user_id = :user_id, total = :total, 
                      payment_method = :payment_method, created_at = :created_at, 
                      updated_at = :updated_at WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':user_id', $order->user_id);
            $stmt->bindParam(':total', $order->total);
            $stmt->bindParam(':payment_method', $order->payment_method);
            $stmt->bindParam(':created_at', $order->created_at);
            $stmt->bindParam(':updated_at', $order->updated_at);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    private function rowToOrder($row) {
        $order = new Order();
        $order->id = $row['id'];
        $order->user_id = $row['user_id'];
        $order->total = $row['total'];
        $order->payment_method = $row['payment_method'];
        $order->created_at = $row['created_at'];
        $order->updated_at = $row['updated_at'];

        return $order;
    }
}
