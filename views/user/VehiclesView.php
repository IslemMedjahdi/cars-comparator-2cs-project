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
        $this->addReviewForm($vehicle["id"]);
        $this->displayFooter();
    }

    private function displayVehicleDetails($vehicle)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicle Details</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1024px;">
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
                        <li class="list-group-item">
                            Acceleration (0-100 km/h) :
                            <span class="text-primary">
                                <?= $vehicle["acceleration"]; ?>s
                            </span>
                        </li>
                        <li class="list-group-item">
                            Fuel Consumption :
                            <span class="text-primary">
                                <?= $vehicle["consumption"]; ?>L/100km
                            </span>
                        </li>
                        <li class="list-group-item">
                            Engine :
                            <span class="text-primary">
                                <?= $vehicle["engine"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Fuel type :
                            <span class="text-primary">
                                <?= $vehicle["fuel_type"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Consumption :
                            <span class="text-primary">
                                <?= $vehicle["consumption"]; ?> L/100km
                            </span>
                        </li>
                        <li class="list-group-item">
                            Pricing range :
                            <span class="text-primary">
                                <?= $vehicle["pricing_range_from"]; ?>EUR -
                                <?= $vehicle["pricing_range_to"]; ?>EUR
                            </span>
                        </li>
                        <li class="list-group-item">
                            Description :
                            <span class="text-primary">
                                <?= $vehicle["description"]; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    private function addReviewForm($vehicleId)
    {

        $user = SessionUtils::getSessionVariable('user') ?? null;

        if (!$user) {
            return;
        }

        ?>
        <div class="d-flex justify-content-center  align-items-center flex-column">
            <div class="w-100 mt-4 border rounded card-body" style="max-width: 1024px;">
                <div id="message"></div>
                <div class="form-group">
                    <label for="rate">Rate:</label>
                    <select name="rate" id="rate">
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Review:</label>
                    <input type="text" class="form-control" id="review" name="review">
                </div>
                <button type="submit" class="btn btn-primary" onclick="addVehicleReview(<?= $vehicleId; ?>)">Submit</button>
            </div>
        </div>
        <?php

    }
}
?>