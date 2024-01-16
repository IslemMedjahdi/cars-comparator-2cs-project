<?php
require_once(__DIR__ . "/../../controllers/MessagesController.php");

$messagesController = new MessagesController();

$response = $messagesController->sendMessage();

echo json_encode($response);

?>