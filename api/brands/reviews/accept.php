<?php
require_once(__DIR__ . "/../../../controllers/BrandReviewController.php");

$brandReviewController = new BrandReviewController();

$response = $brandReviewController->accepteReview();

echo json_encode($response);
?>