<div class="container">
    <h3>Каталог</h3>
    <div class="card-deck">
        <?php if (!empty($orders)) : ?>
            <?php foreach ($this->showOrders() as $order) : ?>
                <details>
                    <summary>Дата оформления заказ: <?php echo $order['order_date'] ; ?></summary>
                    <?php if (!empty($order['products'])) : // Проверяем, есть ли продукты в заказе ?>
                    <?php $summTotal  = 0?>
                        <?php foreach ($order['products'] as $product) : // Перебираем продукты ?>
                            <div class="card text-center">
                                <a href="#">
                                    <img class="card-img-top" src="<?php echo !empty($product['images_url']) ? $product['images_url'] : 'default-image.jpg'; ?>" alt="Card image">
                                    <div class="card-body">
                                        <h2 class="card-text text-muted"><?php echo !empty($product['name_product']) ? $product['name_product'] : 'Без названия'; ?></h2>
                                        <h5 class="card-title">Количество: <?php echo !empty($product['order_amount']) ? $product['order_amount'] : 0; ?></h5>
                                        <div class="card-footer">
                                            <?php echo !empty($product['order_price']) ? "Цена товара: {$product['order_price']} руб" : 'Цена не указана'; ?>
                                            <br>
                                        </div>
                                        <?php $summ = ($product['order_price'])*($product['order_amount'])?>
                                        <?php echo"товар * кол: {$summ}";?>
                                        <?php $summTotal += $summ?>

                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <div style="background-color: aqua">
                    <?php echo"Итого за заказ {$summTotal}"?>
                    </div>
                    <?php else : ?>
                        <p>Нет товаров в этом заказе.</p>
                    <?php endif; ?>
                </details>
            <?php endforeach; ?>
        <?php else : ?>
            <p>У вас нет заказов.</p>
        <?php endif; ?>
    </div>
    <a href="/catalog">Каталог</a>
    <br>
    <a href="/logout">Выйти</a>
</div>

<style>
    details {
        border: 1px solid #aaa;
        border-radius: 4px;
        padding: 0.5em 0.5em 0;
    }

    summary {
        font-weight: bold;
        margin: -0.5em -0.5em 0;
        padding: 0.5em;
    }

    details[open] {
        padding: 0.5em;
    }

    details[open] summary {
        border-bottom: 1px solid #aaa;
        margin-bottom: 0.5em;
    }
    body {
        font-family: sans-serif;
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
        font-size: 12px;
        background-color: white;
    }

    .card-img-top{
        width: 240px;
        height: 320px;
    }

    .card {
        margin-bottom: 20px;
    }

</style>

