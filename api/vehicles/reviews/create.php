<?php
require_once(__DIR__ . "/../../../controllers/VehicleReviewController.php");

$vehicleReviewController = new VehicleReviewController();

$response = $vehicleReviewController->createReview();

echo json_encode($response);
?>