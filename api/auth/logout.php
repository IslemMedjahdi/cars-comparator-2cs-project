<?php

require_once("../../controllers/UserController.php");

$userController = new UserController();

$response = $userController->logout();

echo json_encode($response);


?>