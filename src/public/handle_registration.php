<?php
function validateRegistrationForm(array $arrpost): array
{
    $errors = [];

    if (isset($arrpost['name'])) {
        $name = $arrpost['name'];

        if (empty($name)) {
            $errors['name'] = 'имя не должно быть пустым';
        }elseif (strlen($name) <2) {
            $errors['name'] = 'имя должно быть больше двух символов';
        }
    } else {
        $errors['name']='поле имени должно быть заполнено';
    }

    if (isset($arrpost['email'])) {
        $email = $arrpost['email'];

        if (empty($email)) {
            $errors['email'] = 'почта не должна быть пустой';
        }elseif (strpos($email,'@') === false ) {
            $errors['email'] = 'почта не корректна';
        }else {
            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(['email' => $email]);
            $userdata = $stmt->fetch();

            if ($userdata !== false) {
                $errors['email'] = 'email уже зарегестрирован';
            }
        }
    } else {
            $errors['password'] = 'поля пароля должно быть заполнено';
    }

    if ((isset($arrpost['password'])) ) {
        $password = $arrpost['password'];

        if (empty($password)) {
            $errors['password'] = 'пароль не должен быть пустым';
        }
    } else {
        $errors['password'] = 'поля пароля должно быть заполнено';
    }


    if (isset($arrpost['password_repeat'])){
        $password_repeat = $arrpost['password_repeat'];

        if (empty($password_repeat)){
            $errors['password_repeat'] ='повтор пароля не должен быть пустым';
        }else{
            if ($password !== $password_repeat){
                $errors['password_repeat']= 'пароли не совпадают';
            }
        }
    }else{
        $errors['password_repeat'] = 'поля павтора пароля должно быть заполнено';
    }

    return $errors;
}

$errors = validateRegistrationForm($_POST);

if (empty($errors)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)");

    $hash = password_hash($password, PASSWORD_DEFAULT);

    define('TEST_CONST', 'test');

    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->execute(['email' => $email]);

    print_r ($stmt->fetch()) ;
    echo "вы успешно зарегистрированы";
}else{
    require_once './get_registration.php';
}
?>