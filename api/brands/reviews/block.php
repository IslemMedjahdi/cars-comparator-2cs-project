<?php
require_once(__DIR__ . "/../../../controllers/BrandReviewController.php");

$brandReviewController = new BrandReviewController();

$response = $brandReviewController->blockReview();

echo json_encode($response);
?>