<?php
require_once(__DIR__ . "/../../controllers/BrandController.php");

$brandController = new BrandController();

$brandController->createBrand();
?>