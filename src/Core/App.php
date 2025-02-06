<?php
namespace Core;

class App
{
    private array $routes = [];

    public function run():void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$requestUri])){
            $routeMethods = $this->routes[$requestUri];

            if (isset( $routeMethods[ $requestMethod])){

                $handler = $routeMethods[$requestMethod];

                $class = $handler['class'];
                $method = $handler['method'];

                $obj = new $class();
                $obj->$method();

            } else {
                echo "$requestMethod не поддерживается $requestUri";
            }
        }else {
            require_once './../View/404.php';
        }
    }

    //    public function run(): void
//    {
//        $uri = $_SERVER['REQUEST_URI'];
//        $method = $_SERVER['REQUEST_METHOD'];
//
//        if (array_key_exists($uri, $this->routes)) {
//            $methods = $this->routes[$uri];
//
//            if (array_key_exists($method, $methods)) {
//                $handler = $methods[$method];
//                $class = $handler['class'];
//                $methodName = $handler['method'];
//
//
//                if (class_exists($class) && method_exists($class, $methodName)) {
//                    $obj = new $class();
//                    $obj->$methodName();
//                } else {
//                    echo "Класс или метод не найдены: $class::$methodName";
//                }
//            } else {
//                echo "$method не поддерживается для $uri";
//            }
//        } else {
//            require_once './../View/404.php';
//        }
//    }

    public  function addRoute(string $uriName, string $uriMethod, string $className, string $method): void
    {
        if(!isset($this->routes[$uriName][$uriMethod])){
            $this->routes[$uriName][$uriMethod]['class'] = $className;
            $this->routes[$uriName][$uriMethod]['method'] = $method;
        }else{
            echo "$uriMethod уже зарегистрирован для $uriName" . "\n";
        }
    }

    //    public function addRoute(string $uriName, string $uriMethod, string $className, string $method): void
//    {
//        if (!isset($this->routes[$uriName][$uriMethod])) {
//            $this->routes[$uriName][$uriMethod] = [
//                'class' => $className,
//                'method' => $method
//            ];
//        } else {
//            echo "$uriMethod уже зарегистрирован для $uriName" . "\n";
//        }
//    }


//class App
//{
//    public function run()
//    {
//        $requestUri = $_SERVER['REQUEST_URI'];
//        $requestMethod = $_SERVER['REQUEST_METHOD'];
//
//        switch ($requestUri) {
//            case '/login':
//                if ($requestMethod === 'GET') {
//                    $userController = new UserController();
//                    $userController->getLoginForm();
//                } elseif ($requestMethod === 'POST') {
//                    $userController = new UserController();
//                    $userController->login();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/registration':
//                if ($requestMethod === 'GET') {
//                    $userController = new UserController();
//                    $userController->getRegistrationForm();
//                    //require_once './get_registration.php';
//                } elseif ($requestMethod === 'POST') {
//                    $userController = new UserController();
//                    $userController->registrate();
//                    require_once './handle_registration.php';
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/catalog':
//                if ($requestMethod === 'GET') {
//                    $productController = new ProductController();
//                    $productController->getCatalog();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/add-product':
//                if ($requestMethod === 'GET') {
//                    $bascetController = new BascetController();
//                    $bascetController->getAddProduct();
//                } elseif ($requestMethod === 'POST') {
//                    $bascetController = new BascetController();
//                    $bascetController->addProduct();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/bascet':
//                if ($requestMethod === 'GET') {
//                    $bascetController = new BascetController();
//                    $bascetController->getBascet();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/logout':
//                if ($requestMethod === 'GET') {
//                    require_once './logout.php';
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            case '/orders':
//                if ($requestMethod === 'GET') {
//                    $orderController = new OrderController();
//                    $orderController->getOrder();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//
//
//            case '/order':
//                if ($requestMethod === 'GET') {
//                    $orderController = new OrderController();
//                    $orderController->getOrder();
//                } elseif ($requestMethod === 'POST') {
//                    $orderController = new OrderController();
//                    $orderController->addProduct();
//                } else {
//                    echo "$requestMethod не поддерживается для $requestUri";
//                }
//                break;
//
//            default:
//                http_response_code(404);
//                require_once './../View/404.php';
//                break;
//        }
//    }
//}
//        '/registration' =>[
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'getRegistrationForm',
//            ],
//            'POST' => [
//                'class' => 'Controller\UserController',
//                'method' => 'registrate',
//            ],
//        ],
//
//        '/login' =>[
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'getLoginForm',
//            ],
//            'POST' => [
//                'class' => 'Controller\UserController',
//                'method' => 'login',
//            ],
//        ],

}

//    public function run(): void
//    {
//        $uri = $_SERVER['REQUEST_URI'];
//        $method = $_SERVER['REQUEST_METHOD'];
//
//        if (array_key_exists($uri, $this->routes)) {
//            $methods = $this->routes[$uri];
//
//            if (array_key_exists($method, $methods)) {
//                $handler = $methods[$method];
//                $class = $handler['class'];
//                $methodName = $handler['method'];
//
//                // Проверка существования класса и метода
//                if (class_exists($class) && method_exists($class, $methodName)) {
//                    $obj = new $class();
//                    $obj->$methodName();
//                } else {
//                    echo "Класс или метод не найдены: $class::$methodName";
//                }
//            } else {
//                echo "$method не поддерживается для $uri";
//            }
//        } else {
//            require_once './../View/404.php';
//        }
//    }

//    public function run():void
//    {
//        $uri = $_SERVER['REQUEST_URI'];
//
//        if (array_key_exists($uri, $this->routes)){
//            $method = $_SERVER['REQUEST_METHOD'];
//            $methods = $this->routes[$uri];
//
//            if (array_key_exists( $methods, $methods)){
//
//                $handler = $methods[$method];
//
//                $class = $handler['class'];
//                $methodName = $handler['method'];
//
//                $obj = new $class();
//                $obj->$method();
//
//            } else {
//                echo "$method не поддерживается $uri";
//            }
//        } else {
//            require_once './../View/404.php';
//        }
//    }
//    public function run():void
//    {
//        $requestUri = $_SERVER['REQUEST_URI'];
//        $requestMethod = $_SERVER['REQUEST_METHOD'];
//
//        if (isset($this->routes[$requestUri])){
//            $routeMethods = $this->routes[$requestUri];
//
//            if (isset( $routeMethods[ $requestMethod])){
//
//                $handler = $routeMethods[$requestMethod];
//
//                $class = $handler['class'];
//                $method = $handler['method'];
//
//                $obj = new $class();
//                $obj->$method();
//
//            } else {
//                echo "$requestMethod не поддерживается $requestUri";
//            }
//        }else {
//            require_once './../View/404.php';
//        }
//    }

//        '/add-product' =>[
//            'GET' => [
//                'class' => 'Controller\BascetController',
//                'method' => 'getAddProduct',
//            ],
//            'POST' => [
//                'class' => 'Controller\BascetController',
//                'method' => 'addProduct',
//            ],
//        ],

//        '/catalog' =>[
//            'GET' => [
//                'class' => 'Controller\ProductController',
//                'method' => 'getCatalog',
//            ],
//        ],

//        '/bascet' =>[
//            'GET' => [
//                'class' => 'Controller\BascetController',
//                'method' => 'getBascet',
//            ],
//        ],

//        '/logout' =>[
//            'GET' => [
//                'class' => 'Controller\UserController',
//                'method' => 'logout',
//            ],
//        ],

//        '/order' =>[
//            'GET' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'getOrder',
//            ],
//            'POST' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'createOrder',
//            ],
//        ],

//        '/my_orders' =>[
//            'GET' => [
//                'class' => 'Controller\OrderController',
//                'method' => 'getMyOrders',
//            ],
//        ],