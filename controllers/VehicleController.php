<?php
require_once __DIR__ . '/../utils/SessionUtils.php';
require_once __DIR__ . '/../models/VehicleModel.php';

SessionUtils::startSession();


class VehicleController
{
    public function createVehicle()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin in to create a brand"
            );
        }

        $vehicleModel = new VehicleModel();

        $brand_id = $_POST['brand_id'] ?? null;
        $model = $_POST['model'] ?? null;
        $version = $_POST['version'] ?? null;
        $year = $_POST['year'] ?? null;
        $height = $_POST['height'] ?? null;
        $width = $_POST['width'] ?? null;
        $length = $_POST['length'] ?? null;
        $consumption = $_POST['consumption'] ?? null;
        $engine = $_POST['engine'] ?? null;
        $speed = $_POST['speed'] ?? null;
        $notes = $_POST['notes'] ?? null;
        $fuel_type = $_POST['fuel_type'] ?? null;
        $pricing_range_from = $_POST['pricing_range_from'] ?? null;
        $pricing_range_to = $_POST['pricing_range_to'] ?? null;
        $acceleration = $_POST['acceleration'] ?? null;
        $Image = $_FILES['Image'] ?? null;


        try {
            $vehicleModel->addVehicle($brand_id, $model, $version, $year, $height, $width, $length, $consumption, $engine, $speed, $notes, $fuel_type, $pricing_range_from, $pricing_range_to, $Image, $acceleration);

            return array(
                'status' => 200,
                'message' => "Vehicle created successfully"
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getVehicles()
    {
        $vehicleModel = new VehicleModel();

        try {
            $vehicles = $vehicleModel->getVehicles();

            return array(
                'status' => 200,
                'data' => $vehicles
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }
}
?>