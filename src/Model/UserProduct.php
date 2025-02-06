<?php
namespace Model;

class UserProduct extends Model
{
    public function getProductByUserIdProductId(int $product_id,int $userId): array|false
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute(['product_id' => $product_id, 'user_id' => $userId]);
        return  $stmt->fetch() ?? false;
    }

    public function addOrUpdateUserProduct(int $product_id,int $userId,int $amount,array|false $productAvailability):void
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        if ($productAvailability ) {
            $stmt = $this->pdo->prepare("UPDATE user_products SET amount = amount + :amount WHERE product_id = :product_id AND user_id = :user_id");
            $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);

        } else {
            $stmt = $this->pdo->prepare("INSERT INTO user_products (product_id,amount,user_id) VALUES (:product_id,:amount,:user_id)");
            $stmt->execute(['product_id' => $product_id, 'amount' => $amount, 'user_id' => $userId]);
        }
    }

    public function sumPrice(int $userId):float|null
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $stmt = $this->pdo->prepare("SELECT SUM(amount * price) AS total FROM user_products INNER JOIN products ON user_products.product_id = products.id WHERE user_products.user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $data = $stmt->fetch();

        return $data['total'];
    }

    public function getTotalAmountForUserProduct(array $product):float|null
    {
//        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $userId = $_SESSION['user_id'];

        $kollStmt = $this->pdo->prepare("SELECT SUM(amount) AS total_amount FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $kollStmt->execute(['user_id' => $userId, 'product_id' => $product['id']]);

        return $kollStmt->fetchColumn() ?? 0;
    }

    public function getByUserId(int $userId):array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$userId]);
        return $stmt->fetchAll();
    }

    public function deleteByUserId($userId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$userId]);
    }

    public function getProductAmountById(int $userId)
    {
        $stmt = $this->pdo->prepare("SELECT SUM(amount) AS total_amount FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId,]);
        return $stmt->fetchColumn() ?? 0;
    }


}