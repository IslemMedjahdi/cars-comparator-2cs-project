<?php

require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . "/../../controllers/VehicleController.php";


class ReviewsView extends SharedUserView
{
    public function displayReviewsHomePage()
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
                    $this->displayVehicleReviewsSummaryDetails($vehicle);
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


    private function displayVehicleReviewsSummaryDetails($vehicle)
    {
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" style="overflow: hidden;">
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

                </ul>
                <div class="card-body justify-content-end d-flex">
                    <a href="/cars-comparer-2cs-project/reviews?id=<?= $vehicle["id"]; ?>" class="btn btn-primary">Show
                        Reviews</a>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayVehiclesListPagination($totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link" href="/cars-comparer-2cs-project/reviews?page=<?= $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/reviews?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link" href="/cars-comparer-2cs-project/reviews?page=<?= $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php
    }

    public function displayVehicleReviewsByIdPage()
    {
        $vehicleId = $_GET["id"] ?? null;

        if (!$vehicleId) {
            header("Location: /cars-comparer-2cs-project/reviews");
            exit();
        }

        $vehicleController = new VehicleController();

        $vehicle = $vehicleController->getVehicleById()["data"] ?? null;


        if (!$vehicle) {
            header("Location: /cars-comparer-2cs-project/reviews");
            exit();
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayVehicleDetails($vehicle);
        $this->displayVehicleReviews($vehicleId);
        $this->displayFooter();

    }

    private function displayVehicleDetails($vehicle)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicle Reviews</h2>
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
                    <div class="card-body justify-content-end d-flex">
                        <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" class="btn btn-primary">Show
                            more</a>
                    </div>
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
                    <div class="d-flex justify-content-center w-100 mt-5">
                        <?php
                        $this->displayVehicleReviewsListPagination($vehicleId, $totalPages, $currentPage);
                        ?>
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

    private function displayVehicleReviewsListPagination($vehicleId, $totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/reviews?id=<?= $vehicleId; ?>&page=<?= $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/reviews?id=<?= $vehicleId; ?>&page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/reviews?id=<?= $vehicleId; ?>&page=<?= $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php
    }
}

?>