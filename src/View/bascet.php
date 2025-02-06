<div class="container">
    <h3>Корзина</h3>
    <div class="card-deck">
<!--        --><?php //print_r ($products);?>
        <?php foreach($products as $product):?>
        <?php $totalAmount = $totalProduct->getTotalAmountForUserProduct($product);
        if ($totalAmount > 0):?>
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
                        $productPrice = $product['price'] * $totalProduct->getTotalAmountForUserProduct($product);
                        if(!empty($product['price'])) {echo "{$product['price']} руб * {$totalProduct->getTotalAmountForUserProduct($product)} шт = {$productPrice}";}
                        ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <p style="background-color: grey"><?php echo "Итого {$totalProduct->sumPrice($userId)} руб";?></p>
    </div>
    <a href="/add-product">добавить товар в корзину </a>
    <br>
    <a href="/order">оформить заказ</a>
    <br>
    <a href="/my_orders">мои заказы</a>



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