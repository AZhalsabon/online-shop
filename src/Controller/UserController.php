<?php
namespace Controller;

use Model\User;
class UserController
{
    public function checkSession():void
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("location: /login");
            exit();
        }

    }

    public function getRegistrationForm():void

    {
        require_once './../View/get_registration.php';
    }

    private User $userModel;

    public function __construct()
    {
        $this-> userModel = new User();
    }

    public function registrate()
    {
        $errors = $this->validateRegistrationForm($_POST);

        if(empty($errors)) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $user = new User();
            $user->create($name, $email, $hash);

            header("location: /login");

        }
        require_once './../View/get_registration.php';

    }

    private function validateRegistrationForm(array $arrpost): array
    {
        $errors =[];
        if (isset($arrpost['name'])) {
            $name = $arrpost['name'];

            if (empty($name)) {
                $errors['name'] = 'имя не должно быть пустым';
            } elseif (strlen($name) < 2) {
                $errors['name'] = 'имя должно быть больше двух символов';
            }
        } else {
            $errors['name'] = 'поле имени должно быть заполнено';
        }

        if (isset($arrpost['email'])) {
            $email = $arrpost['email'];

            if (empty($email)) {
                $errors['email'] = 'почта не должна быть пустой';
            } elseif (strpos($email, '@') === false) {
                $errors['email'] = 'почта не корректна';
            } else {

//                $userEmail = new User();
//                $userEmail -> getUserByEmail($email);

                if ($this->userModel->getUserByEmail($email) !== false) {
                    $errors['email'] = 'email уже зарегестрирован';
                }
            }
        } else {
            $errors['password'] = 'поля пароля должно быть заполнено';
        }
        if ((isset($arrpost['password']))) {
            $password = $arrpost['password'];

            if (empty($password)) {
                $errors['password'] = 'пароль не должен быть пустым';
            }
        } else {
            $errors['password'] = 'поля пароля должно быть заполнено';
        }


        if (isset($arrpost['password_repeat'])) {
            $password_repeat = $arrpost['password_repeat'];

            if (empty($password_repeat)) {
                $errors['password_repeat'] = 'повтор пароля не должен быть пустым';
            } else {
                if ($password !== $password_repeat) {
                    $errors['password_repeat'] = 'пароли не совпадают';
                }
            }
        } else {
            $errors['password_repeat'] = 'поля павтора пароля должно быть заполнено';
        }

        return $errors;
    }


    public function getLoginForm():void
    {
        require_once './../View/get_login.php';
    }
    public function login()
    {
        $errors = $this->validateLoginForm($_POST);

        $errors =[];

        if (empty($errors))
        {
            $login = $_POST['login'];
            $passwordLogin = $_POST['password_login'];

            $userData = new User();
            $UserDetails = $userData -> getUserByEmail($login);

            if ($UserDetails === false) {
                $err['login'] = 'неверный логин или пароль';
                require_once './../View/get_login.php';
            } else {
                if (password_verify($passwordLogin, $UserDetails['password'])) {

                    session_start();
                    $_SESSION['user_id'] = $UserDetails['id'];

                    header("location: /catalog");
                    exit;

                } else {
                    $err['password_login'] = 'неверный логин или пароль';
                    require_once '/login';
                }
            }
        }

    }


    private function validateLoginForm(array $arrpost): array
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
            $passwordLogin = $arrpost['password_login'];

            if (empty($passwordLogin)){
                $errors['password_login'] = 'пароль не должен быть пустым';
            }
        }else {
            $errors['password_login'] = 'введите поле пароля';
        }

        return $errors;
    }

    public function logout():void
    {
        session_start();

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        header("Location: /login");
        exit;
    }


}