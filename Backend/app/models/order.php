<?php

namespace Models;

class Order
{
    public int $id;
    public array $products_ids = [];
    public int $user_id;
    public float $total;
    public string $payment_method;
    public string $created_at;
    public string $updated_at;
}