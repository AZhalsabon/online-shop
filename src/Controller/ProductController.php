<?php
namespace Controller;
use Model\Product;
class ProductController
{
    public function getCatalog()
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("location: /login");
            exit();
        }

        $productsAll = new Product();
        $products = $productsAll->getAllProducts();

        require_once './../View/catalog.php';
    }

}