<?php

require_once __DIR__ . "/../../controllers/BrandController.php";
require_once __DIR__ . "/../../controllers/VehicleController.php";

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
                    <btn class="rounded-0 bg-light border p-4 d-flex gap-4">
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
                    </btn>
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
                <btn class="rounded-0 bg-light border p-4 d-flex gap-4">
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
                </btn>
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
                <?php foreach ($vehicles as $vehicle) { ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card">
                            <img style="height: 10rem;object-fit: cover;" class="card-img-top d-flex"
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
                                        <?= $vehicle["length"]; ?>m x
                                        <?= $vehicle["width"]; ?>m x
                                        <?= $vehicle["height"]; ?>m
                                    </span>
                                </li>
                            </ul>
                            <div class="card-body justify-content-end d-flex">
                                <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" class="btn btn-primary">Show
                                    more</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}

?>