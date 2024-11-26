<?php
session_start();
function validateAddProductForm(array $arrpost):array
{
    $errors = [];
     if (isset($arrpost['product_id'])){
         $product_id = $arrpost['product_id'];

         if (empty($product_id)){
             $errors['product_id'] = 'product_id не должно быть пустым';
         }elseif (!is_numeric($product_id)) {
             $errors['product_id'] = 'product_id должен быть числом';
         }else{
             $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
             $stmt = $pdo->prepare("SELECT * FROM products WHERE id=:id");
             $stmt->execute(['id' => $product_id]);
             $product_id = $stmt->fetch();

             if ($product_id === false) {
                 $errors['product_id'] = 'продукта не существует';
             }
         }
     }else {
         $errors['product_id']='поле product_id должно быть заполнено';
     }

    if (isset($arrpost['amount'])){
        $amount = $arrpost['amount'];

        if (empty($amount)){
            $errors['amount'] = 'amount не должно быть пустым';
        }elseif (!is_numeric($amount)) {
            $errors['amount'] = 'amount должен быть числом';
        }
    }else {
        $errors['amount']='поле amount должно быть заполнено';
    }

     return  $errors;
}

$errors = validateAddProductForm($_POST);

if (empty($errors)) {
    if (!isset($_SESSION['user_id'])) {
        $errors['product_id'](" пользователь не авторизован.");
    }
    $product_id = $_POST['product_id'];
    $amount = $_POST['amount'];
    $userId = $_SESSION['user_id'];

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

    $stmt = $pdo->prepare("SELECT * FROM user_products WHERE product_id = :product_id AND user_id = :user_id");
    $stmt->execute(['product_id' => $product_id, 'user_id' => $userId]);
    $productAvailability = $stmt->fetch();

    if($productAvailability){
        $stmt = $pdo->prepare("update user_products set amount = amount + :amount WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);

    }else {
        $stmt = $pdo->prepare("INSERT INTO user_products (product_id,amount,user_id) VALUES (:product_id,:amount,:user_id)");
        $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);
    }

    header("location: /bascet");
    exit;




//    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
//
//    $stmt->execute(['id' => $product_id]);

}else {
    require_once './get_add_product.php';
}
