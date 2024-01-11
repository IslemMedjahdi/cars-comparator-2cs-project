<?php
require_once(__DIR__ . "/../../../controllers/SettingsController.php");

$settingsController = new SettingsController();


$response = $settingsController->addDiaporamaItem();

echo json_encode($response);


?>