<?php
require_once __DIR__ . '/../utils/SessionUtils.php';
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../utils/SessionUtils.php';
require_once __DIR__ . '/../models/ComparisionHistoryModel.php';

SessionUtils::startSession();


class VehicleController
{
    public function createVehicle()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a vehicle"
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
        $description = $_POST['description'] ?? null;
        $fuel_type = $_POST['fuel_type'] ?? null;
        $pricing_range_from = $_POST['pricing_range_from'] ?? null;
        $pricing_range_to = $_POST['pricing_range_to'] ?? null;
        $acceleration = $_POST['acceleration'] ?? null;
        $Image = $_FILES['Image'] ?? null;


        try {
            $vehicleModel->addVehicle($brand_id, $model, $version, $year, $height, $width, $length, $consumption, $engine, $speed, $description, $fuel_type, $pricing_range_from, $pricing_range_to, $Image, $acceleration);

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

        $page = $_GET['page'] ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        $perPage = 8;

        try {
            $vehicles = $vehicleModel->getVehicles($page, $perPage);

            $totalPages = ceil($vehicleModel->getVehiclesCount() / $perPage);

            return array(
                'status' => 200,
                'data' => $vehicles,
                'totalPages' => $totalPages,
                'currentPage' => $page
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function deleteVehicle()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to delete a vehicle"
            );
        }

        $vehicleModel = new VehicleModel();

        $id = $_POST['id'] ?? null;

        try {
            $vehicleModel->deleteVehicle($id);

            return array(
                'status' => 200,
                'message' => "Vehicle deleted successfully"
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getVehiclesByBrandId($brandId)
    {
        if (!$brandId) {
            return array(
                'status' => 400,
                'message' => "Brand id is required"
            );
        }

        $vehicleModel = new VehicleModel();

        try {
            $vehicles = $vehicleModel->getVehiclesByBrandId($brandId);

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

    public function compareVehicles()
    {

        $vehicleModel = new VehicleModel();

        $vehicleIds = $_GET['id'] ?? null;

        if (!$vehicleIds) {
            return array(
                'status' => 400,
                'message' => "Vehicle ids are required"
            );
        }

        $vehicleIds = array_unique($vehicleIds);

        if (count($vehicleIds) < 2) {
            return array(
                'status' => 400,
                'message' => "You must select at least two vehicles"
            );
        }

        try {
            $vehicles = array();
            foreach ($vehicleIds as $vehicleId) {
                $vehicle = $vehicleModel->getVehicleById($vehicleId);
                if (!$vehicle) {
                    return array(
                        'status' => 400,
                        'message' => "Vehicle with id $vehicleId does not exist"
                    );
                }
                array_push($vehicles, $vehicle);
            }

            $userId = SessionUtils::getSessionVariable('user')['id'] ?? null;

            if ($userId) {
                $comparisionHistoryModel = new ComparisionHistoryModel();

                for ($i = 0; $i < count($vehicles); $i++) {
                    for ($j = $i + 1; $j < count($vehicles); $j++) {
                        try {
                            $comparisionHistoryModel->addComparision($userId, $vehicles[$i]['id'], $vehicles[$j]['id']);
                        } catch (ErrorException $e) {
                            // do nothing
                        }
                    }
                }
            }

            $bestValues = array();
            $worstValues = array();
            foreach ($vehicles as $vehicle) {
                foreach ($vehicle as $key => $value) {
                    if ($key === "year" || $key === "speed" || $key === "average_rate") {
                        if (!isset($bestValues[$key])) {
                            $bestValues[$key] = $value;
                        } else {
                            if ($value > $bestValues[$key]) {
                                $bestValues[$key] = $value;
                            }
                        }

                        if (!isset($worstValues[$key])) {
                            $worstValues[$key] = $value;
                        } else {
                            if ($value < $worstValues[$key]) {
                                $worstValues[$key] = $value;
                            }
                        }
                    }
                    if ($key === "consumption" || $key === "pricing_range_from" || $key === "pricing_range_to" || $key === "acceleration") {
                        if (!isset($bestValues[$key])) {
                            $bestValues[$key] = $value;
                        } else {
                            if ($value < $bestValues[$key]) {
                                $bestValues[$key] = $value;
                            }
                        }

                        if (!isset($worstValues[$key])) {
                            $worstValues[$key] = $value;
                        } else {
                            if ($value > $worstValues[$key]) {
                                $worstValues[$key] = $value;
                            }
                        }
                    }
                }
            }



            return array(
                'status' => 200,
                'data' => $vehicles,
                'bestValues' => $bestValues,
                'worstValues' => $worstValues
            );


        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getVehicleById()
    {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            return array(
                'status' => 400,
                'message' => "Vehicle id is required"
            );
        }

        $vehicleModel = new VehicleModel();

        try {
            $vehicle = $vehicleModel->getVehicleById($id);

            return array(
                'status' => 200,
                'data' => $vehicle
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function getMostComparedVehicles()
    {
        $comparisionHistoryModel = new ComparisionHistoryModel();

        try {
            $mostComparedVehicles = $comparisionHistoryModel->getMostComparedVehicles();

            return array(
                'status' => 200,
                'data' => $mostComparedVehicles
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function getMostComparedWithVehicle()
    {
        $id = $_GET['id'] ?? null;

        $comparisionHistoryModel = new ComparisionHistoryModel();

        try {
            $mostComparedVehicles = $comparisionHistoryModel->getMostComparedWithVehicle($id);

            return array(
                'status' => 200,
                'data' => $mostComparedVehicles
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getAllVehicles()
    {
        $vehicleModel = new VehicleModel();

        try {
            $vehicles = $vehicleModel->getAllVehicles();

            return array(
                'status' => 200,
                'data' => $vehicles
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage(),
            );
        }
    }

    public function editVehicle()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to edit a vehicle"
            );
        }

        $vehicleModel = new VehicleModel();

        $id = $_POST['id'] ?? null;
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
        $description = $_POST['description'] ?? null;
        $fuel_type = $_POST['fuel_type'] ?? null;
        $pricing_range_from = $_POST['pricing_range_from'] ?? null;
        $pricing_range_to = $_POST['pricing_range_to'] ?? null;
        $acceleration = $_POST['acceleration'] ?? null;
        $Image = $_FILES['Image'] ?? null;

        try {
            $vehicleModel->editVehicle($id, $brand_id, $model, $version, $year, $height, $width, $length, $consumption, $engine, $speed, $description, $fuel_type, $pricing_range_from, $pricing_range_to, $Image, $acceleration);

            return array(
                'status' => 200,
                'message' => "Vehicle edited successfully"
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