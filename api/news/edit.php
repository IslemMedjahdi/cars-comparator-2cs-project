<?php
require_once(__DIR__ . "/../../controllers/NewsController.php");

$newsController = new NewsController();

$response = $newsController->updateNews();

echo json_encode($response);
?>