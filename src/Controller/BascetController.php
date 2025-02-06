<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;

class BascetController
{
    public function getBascet()
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("location: /login");
            exit();
        }

        $showBasket = new BascetController();
        $products =  $showBasket->showBasket();

        $totalProduct = new UserProduct();
        $userId = $_SESSION['user_id'];

        require_once './../View/bascet.php';

    }

    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';

    }

    private Product $product;

    private UserProduct $userProductModel;

    private Product $productModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->userProductModel = new UserProduct();
        $this->product = new Product();

    }

    public function addProduct():void
    {
        $errors = $this->validateAddProductForm($_POST);

        if (empty($errors)) {
            session_start();

            if (!isset($_SESSION['user_id'])) {
                $this->errors['product_id'](" пользователь не авторизован.");
            }
            $product_id = $_POST['product_id'];
            $amount = $_POST['amount'];
            $userId = $_SESSION['user_id'];

            $productAvailability = $this->userProductModel->getProductByUserIdProductId($product_id,$userId);
            $this->userProductModel->addOrUpdateUserProduct($product_id,$userId,$amount,$productAvailability);

            header("location: /bascet");
            exit;
        }
    }


    private function validateAddProductForm(array $arrpost): array
    {
        $errors = [];

        if (isset($arrpost['product_id'])) {
            $product_id = $arrpost['product_id'];

            if (empty($product_id)) {
                $errors['product_id'] = 'product_id не должно быть пустым';
            } elseif (!is_numeric($product_id)) {
                $errors['product_id'] = 'product_id должен быть числом';
            } else {
//                $productId = new Product();
//                $productId ->getProductById($product_id);

                if ($this->productModel->getProductById($product_id) === false) {
                    $errors['product_id'] = 'продукта не существует';
                }
            }
        } else {
            $errors['product_id'] = 'поле product_id должно быть заполнено';
        }

        if (isset($arrpost['amount'])) {
            $amount = $arrpost['amount'];

            if (empty($amount)) {
                $errors['amount'] = 'amount не должно быть пустым';
            } elseif (!is_numeric($amount)) {
                $errors['amount'] = 'amount должен быть числом';
            }
        } else {
            $errors['amount'] = 'поле amount должно быть заполнено';
        }

        return $errors;
    }

    public function showBasket()
    {
        $checkUser  = new UserController();
        $checkUser ->checkSession();

        $userId = $_SESSION['user_id'];

        $userProducts = $this->userProductModel->getByUserId($userId);



        $productIds = [];

        foreach ($userProducts as $userProduct){
            $productIds[] = $userProduct['product_id'];
        }
        
        if (empty($productIds)){
            return[];
        }

//        $products = $this->product->getProductsByIds($productIds);
//
//        foreach ($userProducts as $userProduct){
//            foreach ($products as $product){
//                if ($userProduct['product_id'] === $product['id']){
//                    $product['amount'] = $userProduct['amount'];
//                }
//            }
//
//        }

        $bascetProducts=[];


        foreach ($userProducts as $userProduct){

            if (isset($userProduct['product_id'])) {
                $productId = $userProduct['product_id'];
                $product = $this->product->getProductById($productId);

                if (isset($userProduct['amount']) && $product) {
                    $product['amount'] = $userProduct['amount'];
                    $bascetProducts[] = $product;
                }
            }
            if (isset($userProduct['product_id']) && isset($userProduct['amount'])) {
            $productId = $userProduct['product_id'];
                if (isset($products[$productId])) {
                    $product = $products[$productId];
                    $product['amount'] = $userProduct['amount'];
                    $bascetProducts[] = $product;
                }
            }
        }
        return $bascetProducts;
    }

    public function get()
    {

    }

}

//    public function addProduct(array $arrpost)
//    {
//        $errors = $this->validateAddProductForm($_POST);
//        if (empty($errors)) {
//            session_start();
//
//            if (!isset($_SESSION['user_id'])) {
//                $this->errors['product_id'](" пользователь не авторизован.");
//            }
//            $product_id = $arrpost['product_id'];
//            $amount = $arrpost['amount'];
//            $userId = $_SESSION['user_id'];
//
//            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
//
//            $stmt = $pdo->prepare("SELECT * FROM user_products WHERE product_id = :product_id AND user_id = :user_id");
//            $stmt->execute(['product_id' => $product_id, 'user_id' => $userId]);
//            $productAvailability = $stmt->fetch();
//
//            if ($productAvailability) {
//                $stmt = $pdo->prepare("UPDATE user_products SET amount = amount + :amount WHERE product_id = :product_id AND user_id = :user_id");
//                $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);
//
//            } else {
//                $stmt = $pdo->prepare("INSERT INTO user_products (product_id,amount,user_id) VALUES (:product_id,:amount,:user_id)");
//                $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);
//            }
//
//            header("location: /bascet");
//            exit;
//        }
//    }
//    public function validateAddProductForm(array $arrpost):array
//    {
//        if (isset($arrpost['product_id'])){
//            $product_id = $arrpost['product_id'];
//
//            if (empty($product_id)){
//                $this->errors['product_id'] = 'product_id не должно быть пустым';
//            }elseif (!is_numeric($product_id)) {
//                $this->errors['product_id'] = 'product_id должен быть числом';
//            }else{
//                $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
//                $stmt = $pdo->prepare("SELECT * FROM products WHERE id=:id");
//                $stmt->execute(['id' => $product_id]);
//                $product_id = $stmt->fetch();
//
//                if ($product_id === false) {
//                    $this->errors['product_id'] = 'продукта не существует';
//                }
//            }
//        }else {
//            $this->errors['product_id']='поле product_id должно быть заполнено';
//        }
//
//        if (isset($arrpost['amount'])){
//            $amount = $arrpost['amount'];
//
//            if (empty($amount)){
//                $this->errors['amount'] = 'amount не должно быть пустым';
//            }elseif (!is_numeric($amount)) {
//                $this->errors['amount'] = 'amount должен быть числом';
//            }
//        }else {
//            $this->errors['amount']='поле amount должно быть заполнено';
//        }
//
//        return  $this->errors;
//    }
//}