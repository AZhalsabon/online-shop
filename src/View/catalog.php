<?php

//if (!isset($_COOKIE['user_id'])){
//    header("location: /get_login.php");
//}
session_start();
if (!isset($_SESSION['user_id'])){
    header("location: /login");
}

$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();

$products = $stmt->fetchAll();

//print_r($products);

?>
<div class="container">
    <h3>Каталог</h3>
    <div class="card-deck">
        <?php foreach($products as $product):?>
        <div class="card text-center">
            <a href="#">
                <div class="card-header">
                    <p> </p>
                </div>
                <img class="card-img-top" src="<?php if (!empty($product['images_url'])) {echo ($product['images_url']);}?>" alt="Card image">
                <div class="card-body">
                    <h2 class="card-text text-muted"><?php if(!empty($product['name_product'])) {echo ($product['name_product']);}?></h2>
                    <a href="#"><h5 class="card-title"><?php if(!empty($product['description'])) {echo ($product['description']);}?></h5></a>
                    <?php if(!empty($product['id'])){echo "product_id товара {$product['id']}";}?>

                    <div class="card-footer">
                        <?php if(!empty($product['price'])) {echo "Цена товара {$product['price']} руб";}?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="/add-product">добавить товар в корзину</a>
    <a href="/logout">Выйти</a>


</div>
<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 20px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>
