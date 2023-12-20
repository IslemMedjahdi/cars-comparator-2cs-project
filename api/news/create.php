<?php
require_once(__DIR__ . "/../../controllers/NewsController.php");

$newsController = new NewsController();

$response = $newsController->createNews();

echo json_encode($response);
?>