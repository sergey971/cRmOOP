<?php
error_reporting(-1);

use App\Model\ConectDB;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = ConectDB::getInstance()->getConnection();
        try{
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        }catch(Exception $e){
            $this -> createTable();
        };
    }
    public function createTable(){
        $query = "CREATE TABLE IF NOT EXISTS`users`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `login` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        try{
            $this->db->exec($query);
            return true;
        }
        catch(PDOException $e){
            return false;
        }
    }
    public function readAll()
    {  
        $query = "SELECT * FROM `users`";
        try{
            $stmt = $this->db->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function create()
    {
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

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
        $query = ("DELETE FROM users WHERE `users`.`id` = :id");
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }  
    
    
    
    
    public function read($id)
    {
        $query = "SELECT * FROM `users` WHERE `id` = :id ";
        try{

            $stmt = $this->db->prepare($query);
            $stmt -> execute([
                ':id' => $id
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }catch (PDOException $e){

        }
    }

    public function update($id, $data)
    {
        $login = $data['login'];
        $is_admin = !empty($data['is_admin']) && $data['is_admin'] !== 0 ? 1 : 0;
        $query = ("UPDATE `users` SET `login` = :login , `is_admin`= :is_admin WHERE id = :id");
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':id'=> $id,
                ':login' => $login,
                ':is_admin' => $is_admin
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
