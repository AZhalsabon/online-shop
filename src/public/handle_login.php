<?php
$login = $_POST['login'];
$password_login = $_POST['password_login'];

function ValidateLoginForm(array $arrpost)
{
    $errors = [];
    if (isset($arrpost['login'])){
        $login = $arrpost['login'];

        if (empty($login)) {
            $errors['login'] = 'логин не должен быть пустым';

        }elseif (strlen($login) < 2){
            $errors['login'] = 'логин должен быть больше двух символов';
        }

    } else {
        $errors['login']='введите поле логина';
    }

    if (isset($arrpost['password_login'])){
        $password_login = $arrpost['password_login'];

        if (empty($password_login)){
            $errors['password_login'] = 'пароль не должен быть пустым';
        }
    }else {
        $errors['password_login'] = 'введите поле пароля';
    }

    return $errors;
}

$err = ValidateLoginForm($_POST);
if (empty($err)){
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->execute(['email' => $login]);
    $userdata = $stmt->fetch();
    if ($userdata === false){
        $err['login'] = 'такого пользователя не существует';
        require_once './get_login.php';
    } else {
        if (password_verify($password_login, $userdata['password'])){
            echo 'вы успешно верифицированы';
        } else {
            $err['password_login'] = 'неверный пароль';
            require_once './get_login.php';
        }
    }
}else{
    require_once './get_login.php';
}

