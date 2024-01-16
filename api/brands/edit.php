<?php
require_once(__DIR__ . "/../../controllers/BrandController.php");

$brandController = new BrandController();

$response = $brandController->editBrand();

echo json_encode($response);

?>