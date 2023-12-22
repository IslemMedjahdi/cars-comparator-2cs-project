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
            <div class="w-100 mt-4 row" style="max-width: 1377px;">
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
                                <?= round($vehicle["average_rate"]); ?> Stars / 5
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

        $response = $vehicleReviewController->getReviewsByVehicleId($vehicleId);

        $vehicleReviews = $response["data"] ?? [];

        $totalPages = $response["totalPages"] ?? 1;

        $currentPage = $response["currentPage"] ?? 1;


        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicle Reviews</h2>
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
                    <div class="d-flex justify-content-center w-100">
                        <?php
                        $this->displayReviewsPagination($vehicleId, $totalPages, $currentPage);
                        ?>
                    </div>
                </div>
                <?php
            }

    }

    private function displayVehicleReview($vehicleReview)
    {
        ?>
            <div class="card mb-3 ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">
                            <?= $vehicleReview["username"]; ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8em;">
                            <?= date_format(date_create($vehicleReview['createdAt']), "Y/m/d H:i:s"); ?>
                        </h6>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?= $vehicleReview["rate"]; ?> Stars / 5
                    </h6>
                    <p class="card-text">
                        <?= $vehicleReview["review"]; ?>
                    </p>
                </div>
            </div>
            <?php
    }

    private function displayReviewsPagination($vehicleId, $totalPages, $currentPage)
    {
        ?>
            <nav>
                <ul class="pagination">
                    <li class="page-item <?= $currentPage == 1 ? "disabled" : ""; ?>">
                        <a class="page-link"
                            href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicleId ?>&page=<?= $currentPage - 1; ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        ?>
                        <li class="page-item <?= $i == $currentPage ? "active" : ""; ?>">
                            <a class="page-link" href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicleId ?>&page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="page-item <?= $totalPages == $currentPage ? "disabled" : ""; ?>">
                        <a class="page-link"
                            href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicleId ?>&page=<?= $currentPage + 1; ?>">Next</a>
                    </li>
                </ul>
            </nav>
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
}
?>