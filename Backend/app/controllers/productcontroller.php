<?php

namespace Controllers;

use Exception;
use Models\Product;
use Repositories\ProductRepository;
use Services\ProductService;

class ProductController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new ProductService();
    }

    public function getAll()
    {
        $products = $this->service->getAll();

        $this->respond($products);
    }

    public function getOne($id)
    {
        $product = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB
        if (!$product) {
            $this->respondWithError(404, "Product not found");
            return;
        }

        $this->respond($product);
    }

    public function create()
    {
        try {
            $json = file_get_contents('php://input');
            $productJson = json_decode($json);

            //var_dump($productJson);

            $product = new Product();
            $product->name = $productJson->name;
            $product->price = $productJson->price;
            $product->description = $productJson->description;
            $product->image = $productJson->image;
            $product->quantity = $productJson->quantity;

            $product = $this->service->insert($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function update($id)
    {
        try {
            $json = file_get_contents('php://input');
            $productJson = json_decode($json);

            var_dump($productJson);

            $product = new Product();
            $product->id = $productJson->id;
            $product->name = $productJson->name;
            $product->price = $productJson->price;
            $product->description = $productJson->description;
            $product->image = $productJson->image;
            $product->quantity = $productJson->quantity;

            $product = $this->service->update($product, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function delete($id)
    {
        try {
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}
