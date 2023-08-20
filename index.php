<?php
error_reporting(E_ALL);

require_once './app/model/User.php';
require_once './app/model/ConectDB.php';
require_once './app/controllers/users/AuthController.php';
require_once './app/controllers/users/UsersController.php';
require_once './app/controllers/HomeController.php';

require_once 'app/router.php';


$router = new Router();

$router->run();
