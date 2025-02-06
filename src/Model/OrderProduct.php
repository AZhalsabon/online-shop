<?php
namespace Model;

class OrderProduct extends Model
{
    public function createOrderProduct($order_id, $product_id, $amount, $price)
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, amount, price) VALUES (:order_id, :product_id, :amount, :price)");
        $stmt->execute(['order_id'=>$order_id, 'product_id'=>$product_id,'amount'=>$amount, 'price'=>$price]);
    }

    public function getByOrderId($orderId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM order_products WHERE order_id = :order_id");
        $stmt->execute(['order_id'=>$orderId]);
        return $stmt->fetchAll();

    }

}