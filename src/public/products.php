<?php

$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL запрос для вставки данных
$sql = $pdo->prepare("INSERT INTO products (name_product, description, images_url, price)
            VALUES (:name_product, :description, :images_url, :price)");

// Подготовка запроса
$stmt = $pdo->prepare($sql);

// Пример данных для вставки
$name_product = "Алгоритмы";
$description = "Алгоритмы — это источник жизненной силы информатики. Это механизмы, которые формируют доказательства, и музыка, которую исполняют программы. История алгоритмов стара, как сама математика.";
$images_url = "/images/algorithm.png";
$price = 2500;

// Привязка параметров
$stmt->bindParam(':name_product', $name_product);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':images_url', $images_url);
$stmt->bindParam(':price', $price);

// Выполнение запроса
$stmt->execute();

echo "Товар успешно добавлен в базу данных.";