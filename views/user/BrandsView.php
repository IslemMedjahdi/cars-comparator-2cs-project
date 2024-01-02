<?php

require_once __DIR__ . "/../../controllers/BrandController.php";
require_once __DIR__ . "/../../controllers/VehicleController.php";
require_once __DIR__ . "/../../controllers/BrandReviewController.php";

require_once __DIR__ . "/SharedUserView.php";

class BrandsView extends SharedUserView
{

    public function displayBrandsPage()
    {
        $brandController = new BrandController();

        $brands = $brandController->getBrands()["data"] ?? [];


        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayBrandsList($brands);
        $this->displayFooter();

    }

    private function displayBrandsList($brands)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Brands</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <?php foreach ($brands as $brand) { ?>
                    <div class="rounded-0 bg-light border p-4 d-flex gap-4">
                        <div>
                            <img class="logo d-flex" style="height: 5rem"
                                src="/cars-comparer-2cs-project/<?php echo $brand["LogoImageURL"]; ?>"
                                alt="<?php echo $brand["name"]; ?>">
                        </div>
                        <div class="d-flex align-items-start gap-2 flex-column">
                            <h1 class="font-weight-bold head">
                                <?php echo $brand["name"]; ?>
                            </h1>
                            <p class="text-justify">
                                <?php
                                $description = $brand["Description"];
                                echo substr($description, 0, 256);
                                if (strlen($description) > 256) {
                                    echo '<span>...</span>';
                                }
                                ?>
                                <a href="/cars-comparer-2cs-project/brands?id=<?php echo $brand["id"]; ?>"> Show more</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    public function displayBrandByIdPage()
    {
        $brandController = new BrandController();

        $brand = $brandController->getBrandById()["data"] ?? null;

        if ($brand == null) {
            header("Location: /cars-comparer-2cs-project/brands");
            exit();
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayBrandDetails($brand);
        $this->displayVehiclesList($brand['id']);
        $this->displayBrandReviews($brand['id']);
        $this->addReviewForm($brand['id']);
        $this->displayFooter();
    }

    private function displayBrandDetails($brand)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Brand Details</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div class="rounded-0 bg-light border p-4 d-flex gap-4">
                    <div>
                        <img class="logo d-flex" style="height: 5rem"
                            src="/cars-comparer-2cs-project/<?php echo $brand["LogoImageURL"]; ?>"
                            alt="<?php echo $brand["name"]; ?>">
                    </div>
                    <div class="d-flex align-items-start gap-2 flex-column">
                        <h1 class="font-weight-bold">
                            <?php echo $brand["name"]; ?>
                        </h1>
                        <p class="text-justify">
                            <?php echo $brand["Description"]; ?>
                        </p>
                        <p class="text-justify">
                            <span class="font-weight-bold">Country of origin: </span>
                            <?php echo $brand["CountryOfOrigin"]; ?>
                        </p>
                        <p class="text-justify">
                            <span class="font-weight-bold">Year founded: </span>
                            <?php echo $brand["YearFounded"]; ?>
                        </p>
                        <p class="text-justify">
                            <span class="font-weight-bold">Website URL: </span>
                            <a href="<?php echo $brand["WebsiteURL"]; ?>">
                                <?php echo $brand["WebsiteURL"]; ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayVehiclesList($brandId)
    {
        $vehicleController = new VehicleController();

        $vehicles = $vehicleController->getVehiclesByBrandId($brandId)["data"] ?? [];

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

    private function displayBrandReviews($brandId)
    {

        $brandReviewController = new BrandReviewController();

        $response = $brandReviewController->getBestReviewsOfBrand($brandId);

        $brandReviews = $response["data"] ?? [];


        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Brand Reviews</h2>
            </div>

            <?php

            if (empty($brandReviews)) {
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
                    foreach ($brandReviews as $brandReview) {
                        $this->displayBrandReview($brandReview);
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php

    }

    private function displayBrandReview($brandReview)
    {
        ?>
        <div class="card mb-3 ">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title">
                        <div class="badge badge-pill badge-primary">
                            <?= $brandReview["username"]; ?>
                        </div>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8em;">
                        <?= date_format(date_create($brandReview['createdAt']), "Y/m/d H:i:s"); ?>
                    </h6>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?= $this->showStars($brandReview["rate"]); ?>
                </h6>
                <p class="card-text">
                    <?= $brandReview["review"]; ?>
                </p>
            </div>
        </div>
        <?php
    }

    private function addReviewForm($brandId)
    {

        $user = SessionUtils::getSessionVariable('user') ?? null;

        if (!$user) {
            return;
        }

        $brandReviewController = new BrandReviewController();

        $existingReview = $brandReviewController->getReviewOfUserByBrandId($brandId)["data"] ?? null;

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
                <button type="submit" class="btn btn-primary" onclick="addBrandReview(<?= $brandId; ?>)">Submit</button>
            </div>
        </div>
        <?php
    }



}

?>