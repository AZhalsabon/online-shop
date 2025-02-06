<?php
namespace Model;

class Product extends Model
{
    public function getProductById($product_id)
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id=:id");
        $stmt->execute(['id' => $product_id]);
        return  $stmt->fetch();

    }

    public function getAllProducts()
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();

        $products = $stmt->fetchAll();

        return $products;
    }

    public function getProductsByIds($productIds):array|false
    {
//        $placeholders =implode(',', array_fill(0, count($productIds), '?'));
//
//        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
//        $stmt->execute($productIds);
//
//        $products = $stmt->fetchAll();
//
//        return $products;

        if (empty($productIds)) {
            return [];
        }

        $placeHolders = '?' . str_repeat(',?',count($productIds) - 1);
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id IN ($placeHolders)");
        $stmt->execute($productIds);

        return $stmt->fetchAll();
    }

}