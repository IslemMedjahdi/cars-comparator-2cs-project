<?php

require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . '/../../controllers/VehicleController.php';

class CompareView extends SharedUserView
{

    function displayCompareHomePage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayComparator();
        $this->displayMostComparedCars();
        $this->displayFooter();
    }

    function displayComparePage()
    {

        $vehicleController = new VehicleController();
        $response = $vehicleController->compareVehicles();

        if ($response['status'] === 400) {
            header("Location: /cars-comparer-2cs-project/compare");
        }

        $vehicles = $response['data'];
        $bestValues = $response['bestValues'];
        $worstValues = $response['worstValues'];

        $this->displayHeader();
        $this->displayHorizontalMenu();

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Comparison result</h2>
            </div>
            <div class="row w-100 mt-4">
                <?php
                foreach ($vehicles as $vehicle) {
                    $this->displayVehicleInfo($vehicle, $bestValues, $worstValues);
                }
                ?>
            </div>
        </div>

        <?php

        $this->displayFooter();
    }

    function displayVehicleInfo($vehicle, $bestValues, $worstValues)
    {
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-light">
                <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" target="_blank"
                    style="overflow: hidden;">
                    <img style="height: 10rem;object-fit: cover;" class="card-img-top d-flex img-hover-transition"
                        src="/cars-comparer-2cs-project/<?= $vehicle["ImageURL"]; ?>" alt="<?= $vehicle["model"]; ?>">
                </a>
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
                    <li style="background-color: <?= $bestValues["year"] === $vehicle["year"] ? "#d4edda" : ($worstValues["year"] === $vehicle["year"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
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
                    <li style="background-color: <?= $bestValues["speed"] === $vehicle["speed"] ? "#d4edda" : ($worstValues["speed"] === $vehicle["speed"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
                        Speed :
                        <span class="text-primary">
                            <?= $vehicle["speed"]; ?>km/h
                        </span>
                    </li>
                    <li style="background-color: <?= $bestValues["acceleration"] === $vehicle["acceleration"] ? "#d4edda" : ($worstValues["acceleration"] === $vehicle["acceleration"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
                        Acceleration (0-100 km/h) :
                        <span class="text-primary">
                            <?= $vehicle["acceleration"]; ?>s
                        </span>
                    </li>
                    <li class="list-group-item">
                        Engine :
                        <span class="text-primary">
                            <?= $vehicle["engine"]; ?>L
                        </span>
                    </li>

                    <li class="list-group-item">
                        Fuel type :
                        <span class="text-primary">
                            <?= $vehicle["fuel_type"]; ?>
                        </span>
                    </li>
                    <li style="background-color: <?= $bestValues["consumption"] === $vehicle["consumption"] ? "#d4edda" : ($worstValues["consumption"] === $vehicle["consumption"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
                        Consumption :
                        <span class="text-primary">
                            <?= $vehicle["consumption"]; ?> L/100km
                        </span>
                    </li>
                    <li style="background-color: <?= $bestValues["pricing_range_from"] === $vehicle["pricing_range_from"] ? "#d4edda" : ($worstValues["pricing_range_from"] === $vehicle["pricing_range_from"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
                        Pricing range :
                        <span class="text-primary">
                            <?= $vehicle["pricing_range_from"]; ?>EUR -
                            <?= $vehicle["pricing_range_to"]; ?>EUR
                        </span>
                    </li>
                    <li style="background-color: <?= $bestValues["average_rate"] === $vehicle["average_rate"] ? "#d4edda" : ($worstValues["average_rate"] === $vehicle["average_rate"] ? "#f8d7da" : "#fff3cd"); ?>;"
                        class="list-group-item">
                        Average Rating :
                        <span>
                            <?= $this->showStars($vehicle["average_rate"]); ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        More Info :
                        <span class="text-primary">
                            <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" target="_blank">Click
                                here</a>
                        </span>
                    </li>

                </ul>
            </div>
        </div>
        <?php
    }

}

?>