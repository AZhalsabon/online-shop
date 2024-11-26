<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: /login");
    exit;
}

$userId = $_SESSION['user_id'];

$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();

$userProducts = $stmt->fetchAll();

function sumPrice($pdo,$userId)
{
    $stmt = $pdo->prepare("SELECT SUM(amount * price) AS total FROM user_products INNER JOIN products ON user_products.product_id = products.id WHERE user_products.user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    $data = $stmt->fetch();
    return $data['total'];
}

$totalPrice = sumPrice($pdo, $userId);

//?>
<div class="container">
    <h3>Корзина</h3>
    <div class="card-deck">
        <?php foreach($userProducts as $product):?>
        <?php
            $kollStmt = $pdo->prepare("SELECT SUM(amount) AS total_amount FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
            $kollStmt->execute(['user_id' => $userId, 'product_id' => $product['id']]);
            $koll = $kollStmt->fetchColumn() ?? 0;
            if ($koll > 0):?>
        <div class="card text-center">
            <a href="#">
                <div class="card-header">
                    <p> </p>
                </div>
                <img class="card-img-top" src="<?php if (!empty($product['images_url'])) {echo ($product['images_url']);}?>" alt="Card image">
                <div class="card-body">
                    <h2 class="card-text text-muted"><?php if(!empty($product['name_product'])) {echo ($product['name_product']);}?></h2>
<!--                    <a href="#"><h5 class="card-title">--><?php //if(!empty($product['description'])) {echo ($product['description']);}?><!--</h5></a>-->
                    <div class="card-footer">
                        <?php
                        $productPrice = $product['price'] * $koll;
                        if(!empty($product['price'])) {echo "{$product['price']} руб * {$koll} шт = {$productPrice}";}
                        ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <p style="background-color: grey"><?php echo "Итого {$totalPrice} руб";?></p>
    </div>
    <a href="/add-product">добавить товар в корзину</a>

</div>
<style>
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
        box-shadow: 1px 2px 10px black;
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