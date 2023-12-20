<?php
require_once(__DIR__ . "/../../controllers/StyleController.php");

$styleController = new StyleController();


$response = $styleController->updateStyles();

echo json_encode($response);


?>