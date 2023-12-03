<?php

require_once("../../controllers/UserController.php");

$userController = new UserController();

$response = $userController->login();

echo json_encode($response);


?>