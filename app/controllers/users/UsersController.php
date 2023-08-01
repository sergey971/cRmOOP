<?php
error_reporting(-1);
require_once ('app/model/User.php');
class UsersController{

    public function index(){
        $userModel = new User();
        $users = $userModel -> readAll();

        include './app/views/users/index.php';
    }

    public function create()
    {
        include './app/views/users/create.php';
    }
    public function store()
    {
        if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['admin'])){
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if($password !== $confirm_password){
                echo 'Password do not match';
                return;
            }
            $userModel = new User();
            $userModel->create($_POST); 
        }
        
    }

    public function delete()
    {
        $userModel = new User();
        $userModel ->delete($_GET['id']);

        header("Location:/blogOOP/index.php?page=users");
    }
}