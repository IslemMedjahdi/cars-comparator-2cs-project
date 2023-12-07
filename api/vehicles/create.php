<?php
require_once(__DIR__ . "/../../controllers/VehicleController.php");

$vehicleController = new VehicleController();

$response = $vehicleController->createVehicle();

echo json_encode($response);
?>