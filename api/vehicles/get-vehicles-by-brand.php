<?php
require_once(__DIR__ . "/../../controllers/VehicleController.php");

$vehicleController = new VehicleController();

$brandId = $_GET["brandId"] ?? null;

$response = $vehicleController->getVehiclesByBrandId($brandId);

echo json_encode($response);
?>