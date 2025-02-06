<?php
namespace Controller;

use Model\UserProduct;
use Model\Order;
use Model\Product;
use Model\OrderProduct;

class OrderController
{
    public function getOrder()
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("location: /login");
            exit();
        }

        $totalProduct = new UserProduct();
        $userId = $_SESSION['user_id'];

        require_once './../View/get_order.php';
    }

    public function getMyOrders()
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("location: /login");
            exit();
        }

        $userId = $_SESSION['user_id'];

        $orders = $this->orderModel->getAllByUserId($userId);

        foreach ($orders as &$order){
            $orderProducts = $this->orderProductModel->getByOrderId($order['id']);


            $productIds = [];
            foreach ($orderProducts as $orderProduct){
                $productIds[] = $orderProduct['product_id'];
            }

            $products = $this->productModel->getProductsByIds($productIds);

            foreach ($orderProducts as $orderProduct){
                foreach ($products as &$product){
                    if ($product['id'] === $orderProduct['product_id']){
                        $product['order_amount'] = $orderProduct['amount'];
                        $product['order_price'] = $orderProduct['price'];
                    }
                }
                unset($product);
            }
            $order['products'] = $products;

        }
        unset($order);

        require_once './../View/orders.php';
    }

    private UserProduct $userProductModel;
    private Order $orderModel;
    private Product $productModel;

    private OrderProduct $orderProductModel;



    public function __construct()
    {
        $this->userProductModel = new UserProduct();
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }

    public function createOrder():void
    {
        $errors = $this->validateOrder($_POST);

        if (empty($errors)) {

            $checkUser  = new UserController();
            $checkUser ->checkSession();

            $userId = $_SESSION['user_id'];
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $country = $_POST['country'];
            $address = $_POST['address'];
            $postalCode = $_POST['postal_code'];
            $number = $_POST['number'];
            $emailAddress = $_POST['email_address'];

//            $order = new Order();
            $this->orderModel->createOrder($userId ,$fname, $lname, $country, $address, $postalCode, $number, $emailAddress);

            $userProducts = $this->userProductModel->getByUserId($userId);//userID productId amount

            $productIds = [];

            foreach ($userProducts as $userProduct){
                $productIds[] = $userProduct['product_id'];//[1,4,5]
            }

            $products = $this->productModel->getProductsByIds($productIds);

            foreach ($userProducts as $userProduct) {
                $product = $products[array_search($userProduct['product_id'], $productIds)];
                $this->orderProductModel->createOrderProduct(
                    $this->orderModel->getLastOrderId(),
                    $userProduct['product_id'],
                    $userProduct['amount'],
                    $product['price']
                );
            }

            $this->userProductModel->deleteByUserId($userId);


            header("location: /catalog");


        }
        require_once './../View/get_order.php';
        echo 'ошибка валидации';

    }

    public function validateOrder(array $arrpost): array|null
    {
        $errors = [];

        if (isset($arrpost['firstname'])){
            $fname = $arrpost['firstname'];

            if (empty($fname)){
                $errors['firstname'] = 'имя не должно быть пустым';
            } elseif (strlen($fname) < 2) {
                $errors['firstname'] = 'имя должно быть больше двух символов';
            }
        } else {
            $errors['firstname'] = 'поле имени должно быть заполнено';
        }


        if (isset($arrpost['lastname'])){
            $lname = $arrpost['lastname'];

            if (empty($lname)){
                $errors['lastname'] = 'фамилия не должна быть пустой';
            } elseif (strlen($lname) < 2) {
                $errors['lastname'] = 'фамилия должна быть больше двух символов';
            }
        } else {
            $errors['lastname'] = 'поле фамилии должно быть заполнено';
        }


        if (isset($arrpost['address'])){
            $address = $arrpost['address'];

            if (empty($address)){
                $errors['address'] = 'адрес не должен быть пустым';
            }
        } else {
            $errors['address'] = 'поле адреса должно быть заполнено';
        }

        if (empty($arrpost['postal_code'])) {
            $errors['postal_code'] = 'индекс не должен быть пустым';
        }


        if (isset($arrpost['number'])){
            $number = $arrpost['number'];

            if (empty($number)){
                $errors['number'] = 'номер не должнен быть пустым';
            } elseif (!(is_numeric($number))) {
                $errors['number'] = 'номер не правильный';
            }
        } else {
            $errors['number'] = 'поле номера должно быть заполнено';
        }


        if (isset($arrpost['email_address'])) {
            $emailAddress = $arrpost['email_address'];

            if (empty($emailAddress)) {
                $errors['email_address'] = 'email не должен быть пустой';
            } elseif (strpos($emailAddress, '@') === false) {
                $errors['email_address'] = 'email не корректен';
            }
        } else {
            $errors['email_address'] = 'поле email должно быть заполнено';
        }
        return $errors;
    }

    private function showOrders()
    {
        $checkUser  = new UserController();
        $checkUser ->checkSession();

        $userId = $_SESSION['user_id'];

        $orders = $this->orderModel->getAllByUserId($userId);

        foreach ($orders as &$order){
            $orderProducts = $this->orderProductModel->getByOrderId($order['id']);


            $productIds = [];
            foreach ($orderProducts as $orderProduct){
                $productIds[] = $orderProduct['product_id'];
            }

            $products = $this->productModel->getProductsByIds($productIds);

            foreach ($orderProducts as $orderProduct){
                foreach ($products as &$product){
                    if ($product['id'] === $orderProduct['product_id']){
                        $product['order_amount'] = $orderProduct['amount'];
                        $product['order_price'] = $orderProduct['price'];
                    }
                }
                unset($product);
            }
            $order['products'] = $products;

        }
        unset($order);

        return $orders;





    }

    public function getOrdersById()
    {
        $userId = $_SESSION['user_id'];


        $orders = $this->showOrders();

        $ordersById = [];

        foreach ($orders as $order){
            if ($order['user_id'] === $userId){
                $ordersById[] = $order;
            }
        }

        return $ordersById;

    }
}
