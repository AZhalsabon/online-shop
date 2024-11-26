<?php
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/login':
        if ($requestMethod === 'GET') {
            require_once './get_login.php';
        } elseif ($requestMethod === 'POST') {
            require_once './handle_login.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;

    case '/registration':
        if ($requestMethod === 'GET') {
            require_once './get_registration.php';
        } elseif ($requestMethod === 'POST') {
            require_once './handle_registration.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;

    case '/catalog':
        if ($requestMethod === 'GET') {
            require_once './catalog.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;

    case '/add-product':
        if ($requestMethod === 'GET') {
            require_once './get_add_product.php';
        } elseif ($requestMethod === 'POST') {
            require_once './handle_add_product.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;

    case '/bascet':
        if ($requestMethod === 'GET') {
            require_once './bascet.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;

    case '/logout':
        if ($requestMethod === 'GET') {
            require_once './logout.php';
        } else {
            echo "$requestMethod не поддерживается для $requestUri";
        }
        break;


    default:
        http_response_code(404);
        require_once './404.php';
        break;
}



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
