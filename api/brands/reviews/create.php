<?php
require_once(__DIR__ . "/../../../controllers/BrandReviewController.php");

$brandReviewController = new BrandReviewController();

$response = $brandReviewController->createReview();

echo json_encode($response);
?>