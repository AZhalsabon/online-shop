<?php
namespace Model;

class Order extends Model
{
    public function createOrder($userId, string $fname, string $lname, string $country, string $address, int $postalCode, int $number, string $emailAddress): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, firstname, lastname, country, address, postal_code, number,email_address) VALUES (:user_id ,:firstname, :lastname, :country, :address, :postal_code, :number, :email_address)");
        $stmt->execute(['user_id'=> $userId,'firstname' => $fname, 'lastname' => $lname, 'country' => $country, 'address' => $address, 'postal_code' => $postalCode, 'number' => $number, 'email_address' => $emailAddress]);
    }

    public function getLastOrderId()
    {
        $stmt = $this->pdo->prepare("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['id'];
    }

    public function getAllByUserId($userId): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$userId]);

        return $stmt->fetchAll();
    }

}