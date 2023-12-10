<?php

require_once("../../controllers/UserController.php");

$userController = new UserController();

$response = $userController->register();

echo json_encode($response);

?>