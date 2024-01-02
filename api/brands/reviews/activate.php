<?php
require_once(__DIR__ . "/../../../controllers/BrandReviewController.php");

$brandReviewController = new BrandReviewController();

$response = $brandReviewController->activateReview();

echo json_encode($response);
?>