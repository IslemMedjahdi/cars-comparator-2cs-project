<?php
require_once(__DIR__ . "/../../controllers/UserController.php");

$userController = new UserController();

$result = $userController->activateUser();

echo json_encode($result);
?>