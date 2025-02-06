<?php
namespace Model;

class User extends Model
{
    public function create(string $name,string $email,string $hash): void
    {
//        $this->pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);
    }

    public function getUserByEmail(string $email)
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch();

        return $userData;
    }





}