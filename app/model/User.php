<?php
error_reporting(-1);

use App\Model\ConectDB;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = ConectDB::getInstance()->getConnection();
    }

    public function readAll()
    {
        $result = $this->db->query("SELECT * FROM `users`");
        $users = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        return $users;
    }

    public function create()
    {
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s'); // Исправлен формат даты здесь

        $query = ("INSERT INTO `users` (`login`, `password`, `is_admin`, `create_at`) VALUES (:login, :password, :is_admin, :created_at)");
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':login' => $login,
                ':password' => $password,
                ':is_admin' => $is_admin,
                ':created_at' => $created_at
            ]);
            header("Location:/blogOOP/index.php?page=users");
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        // $stmt = $this->db->prepare("DELETE FROM users WHERE `users`.`id` = ?");
        // $stmt -> bind_param('id', $id);
        // if($stmt->execute()){
        //     return true;
        // }else{
        //     return false;
        // }
        $query = ("DELETE FROM users WHERE `users`.`id` = :id");
        try{
            $stmt = $this->db->prepare($query);
            $stmt -> execute([
                ':id' => $id
            ]);          
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
