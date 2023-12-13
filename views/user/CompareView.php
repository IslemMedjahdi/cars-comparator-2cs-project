<?php

require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . '/../../controllers/VehicleController.php';

class CompareView extends SharedUserView
{

    function displayCompareHomePage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();

        echo "Compare Home page";

        $this->displayFooter();
    }

    function displayComparePage()
    {

        $vehicleController = new VehicleController();
        $response = $vehicleController->compareVehicles();

        if ($response['status'] === 400) {
            header("Location: /cars-comparer-2cs-project/compare");
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();

        print_r($response['data']);

        $this->displayFooter();
    }

}

?>