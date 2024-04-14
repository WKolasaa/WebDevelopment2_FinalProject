<?php

namespace Repositories;

use Models\Category;
use Models\Product;
use PDO;
use PDOException;
use Repositories\Repository;

class ProductRepository extends Repository
{
    function getAll()
    {
        try {
            $query = "SELECT productID, productName, productDescription, productPrice, productImage, productQuantity FROM products";

            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            $products = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $products[] = $this->rowToProduct($row);
            }

            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $query = "SELECT * FROM products WHERE productID = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $product = $this->rowToProduct($row);

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToProduct($row) {
        $product = new Product();
        $product->id = $row['productID'];
        $product->name = $row['productName'];
        $product->price = $row['productPrice'];
        $product->description = $row['productDescription'];
        $product->image = $row['productImage'];
        $product->quantity = $row['productQuantity'];

        return $product;
    }

    function insert($product)
    {
        //var_dump($product);
        try {
            $query = "INSERT INTO products (productName, productPrice, productDescription, productImage, productQuantity) VALUES (:name, :price, :description, :image, :quantity)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':name', $product->name);
            $stmt->bindParam(':price', $product->price);
            $stmt->bindParam(':description', $product->description);
            $stmt->bindParam(':image', $product->image);
            $stmt->bindParam(':quantity', $product->quantity);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($product, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE products SET productName = :name, productPrice = :price, productDescription = :description, productImage = :image, productQuantity = :quantity WHERE productID = :id");

            $stmt->bindParam(':name', $product->name);
            $stmt->bindParam(':price', $product->price);
            $stmt->bindParam(':description', $product->description);
            $stmt->bindParam(':image', $product->image);
            $stmt->bindParam(':quantity', $product->quantity);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $this->getOne($id);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM products WHERE productID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
