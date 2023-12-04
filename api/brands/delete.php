<?php
require_once(__DIR__ . "/../../controllers/BrandController.php");

$brandController = new BrandController();

$response = $brandController->deleteBrand();

echo json_encode($response);

?>