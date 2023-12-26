<?php
require_once(__DIR__ . "/../../../controllers/VehicleReviewController.php");

$vehicleReviewController = new VehicleReviewController();

$response = $vehicleReviewController->blockReview();

echo json_encode($response);
?>