<?php
require_once(__DIR__ . "/../../../controllers/VehicleReviewController.php");

$vehicleReviewController = new VehicleReviewController();

$response = $vehicleReviewController->accepteReview();

echo json_encode($response);
?>