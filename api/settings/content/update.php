<?php
require_once(__DIR__ . "/../../../controllers/SettingsController.php");

$settingsController = new SettingsController();


$response = $settingsController->updateContent();

echo json_encode($response);


?>