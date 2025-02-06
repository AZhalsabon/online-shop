<?php
//class Login
//{
//    private $pdo;
//    private $errors = [];
//
//    public function __construct($nameDb, $userName, $passwordDb)
//    {
//        $this->pdo = new PDO($nameDb, $userName, $passwordDb);
//    }
//
//    public function getErrors(): array
//    {
//        return $this->errors;
//    }
//
//    public function validateLoginForm(array $arrpost)
//    {
//        if (isset($arrpost['login'])){
//            $login = $arrpost['login'];
//
//            if (empty($login)) {
//                $this->errors['login'] = 'логин не должен быть пустым';
//
//            }elseif (strlen($login) < 2){
//                $this->errors['login'] = 'логин должен быть больше двух символов';
//            }
//        } else {
//            $this->errors['login']='введите поле логина';
//        }
//
//        if (isset($arrpost['password_login'])){
//            $passwordLogin = $arrpost['password_login'];
//
//            if (empty($passwordLogin)){
//                $this->errors['password_login'] = 'пароль не должен быть пустым';
//            }
//        }else {
//            $this->errors['password_login'] = 'введите поле пароля';
//        }
//
//        return $this->errors;
//    }
//
//    public function login(array $arrpost)
//    {
//        $login = $arrpost['login'];
//        $passwordLogin = $arrpost['password_login'];
//
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
//        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
//        $stmt->execute(['email' => $login]);
//        $userData = $stmt->fetch();
//
//        if ($userData === false){
//            $err['login'] = 'неверный логин или пароль';
//            require_once './get_login.php';
//        } else {
//            if (password_verify($passwordLogin, $userData['password'])){
////              setcookie('user_id',$userData['id']);
//
//                session_start();
//                $_SESSION['user_id'] = $userData['id'];
//
//                header("location: /catalog");
//                exit;
//                //echo 'вы успешно верифицированы';
//            } else {
//                $err['password_login'] = 'неверный логин или пароль';
//                require_once '/login';
//            }
//        }
//    }
//
//}
//
//$login = new Login('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
//$errors = $login->validateLoginForm($_POST);
//
//if(empty($errors)){
//    $login->login($_POST);
//}else{
//    require_once './get_login.php';
//
//}




//function validateLoginForm(array $arrpost): array
//{
//    $errors = [];
//
//    if (isset($arrpost['login'])){
//        $login = $arrpost['login'];
//
//        if (empty($login)) {
//            $errors['login'] = 'логин не должен быть пустым';
//
//        }elseif (strlen($login) < 2){
//            $errors['login'] = 'логин должен быть больше двух символов';
//        }
//    } else {
//        $errors['login']='введите поле логина';
//    }
//
//    if (isset($arrpost['password_login'])){
//        $passwordLogin = $arrpost['password_login'];
//
//        if (empty($passwordLogin)){
//            $errors['password_login'] = 'пароль не должен быть пустым';
//        }
//    }else {
//        $errors['password_login'] = 'введите поле пароля';
//    }
//
//    return $errors;
//}
//
//$err = validateLoginForm($_POST);
//
//if (empty($err)){
//    $login = $_POST['login'];
//    $passwordLogin = $_POST['password_login'];
//
//    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
//    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
//    $stmt->execute(['email' => $login]);
//    $userData = $stmt->fetch();
//
//    if ($userData === false){
//        $err['login'] = 'неверный логин или пароль';
//        require_once './get_login.php';
//    } else {
//        if (password_verify($passwordLogin, $userData['password'])){
////            setcookie('user_id',$userData['id']);
//
//            session_start();
//            $_SESSION['user_id'] = $userData['id'];
//
//            header("location: /catalog");
//            exit;
//            //echo 'вы успешно верифицированы';
//        } else {
//            $err['password_login'] = 'неверный логин или пароль';
//            require_once '/login';
//        }
//    }
//}else{
//    require_once './get_login.php';
//}

