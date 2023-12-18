<?php

require_once __DIR__ . "/../../controllers/VehicleController.php";

require_once __DIR__ . "/SharedUserView.php";

class VehiclesView extends SharedUserView
{

    public function displayVehiclesPage()
    {
        $vehicleController = new VehicleController();

        $vehicles = $vehicleController->getVehicles()["data"] ?? [];

        $this->displayHeader();
        $this->displayHorizontalMenu();

        $this->displayVehiclesList($vehicles);

        $this->displayFooter();
    }

    private function displayVehiclesList($vehicles)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicles</h2>
            </div>
            <div class="w-100 mt-4 row" style="max-width: 1377px;">
                <?php foreach ($vehicles as $vehicle) {
                    $this->displayVehicleSummaryDetails($vehicle);
                } ?>
            </div>
        </div>
        <?php
    }



    public function displayVehicleByIdPage()
    {
        $vehicleController = new VehicleController();

        $vehicle = $vehicleController->getVehicleById()["data"] ?? null;

        if (!$vehicle) {
            header("Location: /cars-comparer-2cs-project/vehicles");
            exit();
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayVehicleDetails($vehicle);
        $this->displayFooter();
    }

    private function displayVehicleDetails($vehicle)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicle Details</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div class="card bg-light">
                    <img style="object-fit: contain;height: auto;" class="card-img-top d-flex"
                        src="/cars-comparer-2cs-project/<?= $vehicle["ImageURL"]; ?>" alt="<?= $vehicle["model"]; ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $vehicle["model"]; ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?= $vehicle["brand_name"]; ?>
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Version :
                            <span class="text-primary">
                                <?= $vehicle["version"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Year :
                            <span class="text-primary">
                                <?= $vehicle["year"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Dimensions :
                            <span class="text-primary">
                                <?= $vehicle["length"]; ?>cm x
                                <?= $vehicle["width"]; ?>cm x
                                <?= $vehicle["height"]; ?>cm
                            </span>
                        </li>
                        <li class="list-group-item">
                            Speed :
                            <span class="text-primary">
                                <?= $vehicle["speed"]; ?>km/h
                            </span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
}
?>