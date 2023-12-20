<?php
require_once(__DIR__ . "/../../controllers/NewsController.php");

$newsController = new NewsController();

$response = $newsController->deleteNews();

echo json_encode($response);
?>