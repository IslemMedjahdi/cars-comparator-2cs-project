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
}
?>