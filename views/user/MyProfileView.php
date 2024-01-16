<?php

require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . '/../../controllers/UserController.php';

class MyProfileView extends SharedUserView
{

    public function displayProfilePage()
    {

        $userController = new UserController();

        $user = $userController->getSessionUser()["data"] ?? null;

        if (!$user) {
            header("Location: /cars-comparer-2cs-project/auth/login");
            return;
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayProfile($user);
        $this->displayFavoriteVehicles();
        $this->displayReviewsHistory();
        $this->displayFooter();
    }

    private function displayProfile($user)
    {


        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Profile</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div class="rounded-0 bg-light border p-4 d-flex gap-4">
                    <ul class="list-group list-group-flush w-100">
                        <li class="list-group-item">
                            Full Name :
                            <span class="text-primary">
                                <?= $user["firstName"] . " " . $user["lastName"] ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Email :
                            <span class="text-primary">
                                <?= $user["email"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Sexe :
                            <span class="text-primary">
                                <?= $user["sexe"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Birth Date :
                            <span class="text-primary">
                                <?php echo $user["birthDate"]; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            createdAt:
                            <span class="text-primary">
                                <?= date_format(date_create($user['createdAt']), "Y/m/d H:i:s"); ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayFavoriteVehicles()
    {

        $vehicleReviewController = new VehicleReviewController();

        $vehicles = $vehicleReviewController->getMyBestReviews()["data"] ?? null;

        ?>
        <div class="w-100">
            <div class="d-flex justify-content-center align-items-center flex-column w-100">
                <div class="mt-4">
                    <h2 class="head">My Best Vehicles</h2>
                </div>
                <div class="w-100 mt-4 row" style="max-width: 1377px;">
                    <?php foreach ($vehicles as $vehicle) {
                        $this->displayVehicleWithReview($vehicle);
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayVehicleWithReview($vehicle)
    {
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["vehicleId"]; ?>" style="overflow: hidden;">
                    <img style="height: 10rem;object-fit: cover;" class="card-img-top d-flex img-hover-transition"
                        src="/cars-comparer-2cs-project/<?= $vehicle["vehicleImage"]; ?>"
                        alt="<?= $vehicle["vehicleModel"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $vehicle["vehicleModel"]; ?>
                    </h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Version :
                        <span class="text-primary">
                            <?= $vehicle["vehicleVersion"]; ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        Year :
                        <span class="text-primary">
                            <?= $vehicle["vehicleYear"]; ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span>
                            <?= $this->showStars($vehicle["rate"]); ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }

    private function displayReviewsHistory()
    {

        $vehicleReviewController = new VehicleReviewController();

        $reviews = $vehicleReviewController->getMyReviewsHistory()["data"] ?? null;

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Reviews History</h2>
            </div>
            <?php

            if (empty($reviews)) {
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
                    foreach ($reviews as $vehicleReview) {
                        $this->displayVehicleReview($vehicleReview);
                    }
                    ?>
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
                <div class="badge badge-pill badge-primary">
                    <?= $vehicleReview['vehicleModel'] ?> -
                    <?= $vehicleReview['vehicleVersion'] ?> -
                    <?= $vehicleReview['vehicleYear'] ?>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="card-title">
                        <?php
                        $statusColor = ($vehicleReview['status'] === 'accepted') ? 'success' : (($vehicleReview['status'] === 'pending') ? 'warning' : (($vehicleReview['status'] == 'blocked') ? 'danger' : 'dark'));
                        ?>
                        <div class="badge badge-pill badge-<?= $statusColor ?> text-uppercase">
                            <?= $vehicleReview['status'] ?>
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
}
?>