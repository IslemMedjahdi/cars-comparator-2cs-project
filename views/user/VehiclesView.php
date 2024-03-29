<?php

require_once __DIR__ . "/../../controllers/VehicleController.php";
require_once __DIR__ . "/../../controllers/VehicleReviewController.php";

require_once __DIR__ . "/SharedUserView.php";

class VehiclesView extends SharedUserView
{

    public function displayVehiclesPage()
    {
        $vehicleController = new VehicleController();

        $response = $vehicleController->getVehicles();

        $vehicles = $response["data"] ?? [];

        $totalPages = $response["totalPages"] ?? 1;

        $currentPage = $response["currentPage"] ?? 1;

        $this->displayHeader();
        $this->displayHorizontalMenu();

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicles</h2>
            </div>
            <div class="w-100 mt-4 row" style="max-width: 1377px;row-gap: 1rem;">
                <?php foreach ($vehicles as $vehicle) {
                    $this->displayVehicleSummaryDetails($vehicle);
                } ?>
                <div class="d-flex justify-content-center w-100 mt-5">
                    <?php
                    $this->displayVehiclesListPagination($totalPages, $currentPage);
                    ?>
                </div>
            </div>
        </div>
        <?php
        $this->displayFooter();
    }



    private function displayVehiclesListPagination($totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link" href="/cars-comparer-2cs-project/vehicles?page=<?= $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/vehicles?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link" href="/cars-comparer-2cs-project/vehicles?page=<?= $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
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
        $this->displayVehicleReviews($vehicle["id"]);
        $this->addReviewForm($vehicle["id"]);
        $this->displayMostComparedVehiclesWith($vehicle["id"]);
        $this->displayComparatorToVehicle($vehicle["id"]);
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
                        <li class="list-group-item">
                            Average Rating :
                            <span class="text-primary">
                                <?= $this->showStars($vehicle["average_rate"]); ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayVehicleReviews($vehicleId)
    {

        $vehicleReviewController = new VehicleReviewController();

        $response = $vehicleReviewController->getBestReviewsOfVehicle($vehicleId);

        $vehicleReviews = $response["data"] ?? [];


        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicle Best Reviews</h2>
            </div>

            <?php

            if (empty($vehicleReviews)) {
                ?>
                <div class="w-100 mt-4 border rounded card-body bg-light" style="max-width: 1024px;">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="py-4">
                            <h2>No reviews yet</h2>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="w-100 mt-4 border rounded card-body bg-light" style="max-width: 1024px;">
                    <?php
                    foreach ($vehicleReviews as $vehicleReview) {
                        $this->displayVehicleReview($vehicleReview);
                    }
                    ?>
                    <div>
                        <a href="/cars-comparer-2cs-project/reviews?id=<?= $vehicleId; ?>" class="btn btn-primary btn-block"><i
                                class="bi bi-card-list"></i> View All Reviews</a>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
        <?php

    }

    private function displayVehicleReview($vehicleReview)
    {
        ?>
        <div class="card mb-3 ">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title">
                        <div class="badge badge-pill badge-primary">
                            <?= $vehicleReview["username"]; ?>
                        </div>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8em;">
                        <?= date_format(date_create($vehicleReview['createdAt']), "Y/m/d H:i:s"); ?>
                    </h6>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?= $this->showStars($vehicleReview["rate"]); ?>
                </h6>
                <p class="card-text">
                    <?= $vehicleReview["review"]; ?>
                </p>
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

        $vehicleReviewController = new VehicleReviewController();

        $existingReview = $vehicleReviewController->getReviewOfUserByVehicleId($vehicleId)["data"] ?? null;

        ?>
        <div class="d-flex justify-content-center  align-items-center flex-column w-100">
            <div class="w-100 mt-4 border rounded card-body" style="max-width: 1024px;">
                <div id="message"></div>
                <div class="form-group">
                    <label for="rate">Rate:</label>
                    <select class="form-control" name="rate" id="rate">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option value="<?= $i; ?>" <?= $existingReview && $existingReview["rate"] == $i ? "selected" : "" ?>>
                                <?= $i; ?> Stars
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Review:</label>
                    <input type="text" class="form-control" id="review" name="review"
                        value="<?= $existingReview ? $existingReview["review"] : "" ?>">
                </div>
                <button type="submit" class="btn btn-primary" onclick="addVehicleReview(<?= $vehicleId; ?>)">Submit</button>
            </div>
        </div>
        <?php
    }

    protected function displayMostComparedVehiclesWith($vehicleId)
    {

        $vehicleController = new VehicleController();

        $mostComparedVehiclesPairs = $vehicleController->getMostComparedWithVehicle()["data"] ?? [];


        if (count($mostComparedVehiclesPairs) == 0) {
            return;
        }

        ?>

        <div class="w-100 d-flex justify-content-center">
            <div class="w-100 mt-4 border rounded card-body d-flex justify-content-center  align-items-center flex-column "
                style="max-width: 1024px;">
                <div class="mt-5">
                    <h2 class="head">Most Compared To</h2>
                </div>
                <div class="w-100 row">
                    <?php
                    foreach ($mostComparedVehiclesPairs as $pair) {
                        $this->displayMostComparedCarsRow($pair["vehicle_1"], $pair["vehicle_2"], $pair["count"]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayMostComparedCarsRow($vehicle1, $vehicle2, $count)
    {

        $vehicles = [$vehicle1, $vehicle2];

        ?>
        <div class="p-1 col-md-6 w-100">
            <div class="box-shadow-lg p-4 bg-light border">
                <div class="row">
                    <?php
                    foreach ($vehicles as $vehicle) {
                        ?>
                        <div class="col-md-6">
                            <div style="overflow: hidden;">
                                <img class="img-hover-transition" style="height: 10rem;object-fit: cover;width: 100%;"
                                    src="/cars-comparer-2cs-project<?= $vehicle["ImageURL"] ?>" />
                            </div>
                            <div class="form-group mt-4">
                                <label>Brand:</label>
                                <input disabled class="form-control" value=<?= $vehicle["brand_name"] ?> />
                            </div>
                            <div class="form-group">
                                <label>Vehicle:</label>
                                <input disabled class="form-control"
                                    value="<?= $vehicle["model"] ?>-<?= $vehicle["version"] ?>-<?= $vehicle["year"] ?>" />
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <a href="/cars-comparer-2cs-project/compare?id[]=<?= $vehicle1["id"] ?>&id[]=<?= $vehicle2["id"] ?>"
                        class="btn btn-primary btn-block"><i class="bi bi-card-list"></i> Preview</a>
                    <span class="text-muted" style="font-size: 0.8em;">Compared
                        <?= $count ?> times
                    </span>
                </div>
            </div>
        </div>

        <?php
    }

    protected function displayComparatorToVehicle($vehicleId)
    {

        $brandController = new BrandController();
        $brands = $brandController->getBrands()["data"] ?? [];

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-5">
                <h2 class="head">Compare This vehicle </h2>
            </div>
            <div style="max-width: 1024px;"
                class="w-100 d-flex justify-content-center flex-column align-items-center bg-light  mt-4 p-4">
                <div id="message" class="w-100">

                </div>
                <div class="row w-100">
                    <input type="hidden" id="vehicle-1" value="<?= $vehicleId; ?>" />
                    <div class="col-md-4 border-right">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 2);
                        ?>
                    </div>
                    <div class="col-md-4 border-right">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 3);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 4);
                        ?>
                    </div>
                </div>
                <div class="mt-4 w-100">
                    <button class="btn btn-primary btn-block" onclick="onCompareClick()"><i class="bi bi-card-list"></i>
                        Compare</button>
                </div>
            </div>
        </div>
        <?php
    }



}
?>