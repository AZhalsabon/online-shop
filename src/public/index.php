<?php
require_once './../Core/Autoload.php';

use Controller\UserController;
use Controller\BascetController;
use Controller\ProductController;
use Controller\OrderController;

use Core\App;
use Core\Autoload;

Autoload::registrate(__DIR__ . "/../");

$app = new App();

$app->addRoute('/registration', 'GET', UserController::class, 'getRegistrationForm');
$app->addRoute('/registration', 'POST', UserController::class, 'registrate');
$app->addRoute('/login', 'GET', UserController::class, 'getLoginForm');
$app->addRoute('/login', 'POST', UserController::class, 'login');
$app->addRoute('/logout', 'GET', UserController::class, 'logout');
$app->addRoute('/catalog', 'GET', ProductController::class, 'getCatalog');
$app->addRoute('/add-product', 'GET', BascetController::class, 'getAddProduct');
$app->addRoute('/add-product', 'POST', BascetController::class, 'addProduct');
$app->addRoute('/bascet', 'GET', BascetController::class, 'getBascet');
$app->addRoute('/order', 'GET', OrderController::class, 'getOrder');
$app->addRoute('/order', 'POST', OrderController::class, 'createOrder');
$app->addRoute('/my_orders', 'GET', OrderController::class, 'getMyOrders');


$app->run();
//use Core\App;
//
//$autoload = function (string $className){
//
//    $handlePath = str_replace('\\', '/',$className);
//    $path = "./../$handlePath.php";
//
//    if (file_exists($path)){
//        require_once $path;
//
//        return true;
//    }
//    return false;
//};
//
//spl_autoload_register($autoload);
//
//$app = new App();
//$app->run();



//$autoloadCore = function (string $className){
//    $path = "./../Core/$className.php";
//
//    if (file_exists($path)){
//        require_once $path;
//
//        return true;
//    }
//    return false;
//};
//
//$autoloadController = function (string $className){
//    $path = "./../Controller/$className.php";
//
//    if (file_exists($path)){
//        require_once $path;
//
//        return true;
//    }
//    return false;
//};
//
//$autoloadModel = function (string $className){
//    $path = "./../Model/$className.php";
//
//    if (file_exists($path)){
//        require_once $path;
//
//        return true;
//    }
//    return false;
//};
//
//spl_autoload_register($autoloadCore);
//spl_autoload_register($autoloadController);
//spl_autoload_register($autoloadModel);
//
//$app = new App();
//$app->run();



//require_once './../Controller/UserController.php';
//require_once './../Controller/BascetController.php';
//require_once './../Controller/ProductController.php';
//
//
//$requestUri = $_SERVER['REQUEST_URI'];
//$requestMethod = $_SERVER['REQUEST_METHOD'];
//
//switch ($requestUri) {
//    case '/login':
//        if ($requestMethod === 'GET') {
//            $userController = new UserController();
//            $userController->getLoginForm();
//        } elseif ($requestMethod === 'POST') {
//            $userController = new UserController();
//            $userController->login();
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//    case '/registration':
//        if ($requestMethod === 'GET') {
//            $userController = new UserController();
//            $userController->getRegistrationForm();
//            //require_once './get_registration.php';
//        } elseif ($requestMethod === 'POST') {
//            $userController = new UserController();
//            $userController->registrate();
//            require_once './handle_registration.php';
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//    case '/catalog':
//        if ($requestMethod === 'GET') {
//            $productController = new ProductController();
//            $productController->getCatalog();
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//    case '/add-product':
//        if ($requestMethod === 'GET') {
//            $bascetController = new BascetController();
//            $bascetController->getAddProduct();
//        } elseif ($requestMethod === 'POST') {
//            $bascetController = new BascetController();
//            $bascetController->addProduct();
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//    case '/bascet':
//        if ($requestMethod === 'GET') {
//            $bascetController = new BascetController();
//            $bascetController->getBascet();
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//    case '/logout':
//        if ($requestMethod === 'GET') {
//            require_once './logout.php';
//        } else {
//            echo "$requestMethod не поддерживается для $requestUri";
//        }
//        break;
//
//
//    default:
//        http_response_code(404);
//        require_once './../View/404.php';
//        break;
//}



//if ($requestUri === '/login') {
//
//    if ($requestMethod === 'GET') {
//        require_once './get_login.php';
//    }elseif ($requestMethod === 'POST') {
//        require_once './handle_login.php';
//    }else{
//        echo "$requestMethod не поддерживатеся $requestUri";
//    }
//
//}elseif ($requestUri === '/handle-login') {
//    require_once './handle_login.php';
//}else{
//    http_response_code(404);
//    require_once './404.php';
//}
//
//if ($requestUri === '/registration') {
//
//    if ($requestMethod === 'GET') {
//        require_once './get_registration.php';
//    }elseif ($requestMethod === 'POST') {
//        require_once './handle_registration.php';
//    }else{
//        echo "$requestMethod не поддерживатеся $requestUri";
//    }
//
//}elseif ($requestUri === '/handle-registration') {
//    require_once './handle_registration.php';
//}else{
//    http_response_code(404);
//    require_once './404.php';
//}

//if ($requestUri === '/catalog') {
//
//    if ($requestMethod === 'GET') {
//        require_once './catalog.php';
//    }else{
//        echo "$requestMethod не поддерживатеся $requestUri";
//    }
//}else{
//    http_response_code(404);
//    require_once './404.php';
//}
