<?php

require_once __DIR__ . '/../../controllers/UserController.php';

class SharedUserView
{
    public function displayNotFoundPage()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
            <div class="text-center">
                <h1 class="display-1 font-weight-bold">404</h1>
                <p> <span class="text-danger">Opps!</span> Page not found.</p>
                <p class="lead">
                    The page you’re looking for doesn’t exist.
                </p>
                <a href="/cars-comparer-2cs-project" class="btn btn-primary">Go Home</a>
            </div>
        </div>
        <?php
    }

    protected function displayHeader()
    {
        ?>
        <div class="d-flex justify-content-center border-bottom">
            <header style="max-width: 1377px;" class="p-2 d-flex justify-content-between w-100 align-items-center">
                <a href="/cars-comparer-2cs-project">
                    <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="logo"
                        style="width: 12rem; height: 4rem;object-fit: contain;" />
                </a>
                <?php
                $this->displaySocialMedia();
                $this->displayAuthButtons();
                ?>
            </header>
        </div>
        <?php
    }

    private function displaySocialMedia()
    {
        ?>
        <div class="d-flex gap-2 align-items-center">
            <a href="https://www.facebook.com/islem.medjahdi.9" target="_blank"
                class="d-flex align-items-center justify-content-center rounded"
                style="font-size: 1.2rem;background-color: #1877F2;height: 2rem; width: 2rem">
                <i class="bi bi-facebook text-white"></i>
            </a>
            <a href="https://www.instagram.com/islem_medjahdi" target="_blank"
                class="d-flex align-items-center justify-content-center rounded"
                style="font-size: 1.2rem;background-color: #cd486b;height: 2rem; width: 2rem">
                <i class="bi bi-instagram text-white"></i>
            </a>
            <a href="https://www.linkedin.com/in/islem-medjahdi" target="_blank"
                class="d-flex align-items-center justify-content-center rounded"
                style="font-size: 1.2rem;background-color: #0077b5;height: 2rem; width: 2rem">
                <i class="bi bi-linkedin text-white"></i>
            </a>
        </div>
        <?php
    }

    private function displayAuthButtons()
    {
        $userController = new UserController();

        $user = $userController->getSessionUser()["data"] ?? null;

        if ($user) {
            ?>

            <div class="d-flex gap-2 align-items-center">

                <a href="/cars-comparer-2cs-project/auth/profile" class="btn btn-primary btn-outline-primary">
                    <i class="bi bi-person-circle"></i>
                    My Profile
                </a>

                <?php if ($user["role"] == "admin") { ?>
                    <a href="/cars-comparer-2cs-project/admin" target="_blank" class="btn btn-primary btn-outline-primary">
                        Admin
                    </a>
                <?php } ?>

                <button onclick="logout()" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </div>
            <?php
            return;
        }
        ?>
        <div class="d-flex gap-2 align-items-center">
            <a href="/cars-comparer-2cs-project/auth/login" class="btn btn-primary btn-outline-primary">Login</a>
            <a href="/cars-comparer-2cs-project/auth/register" class="btn btn-outline-primary">Register</a>
        </div>
        <?php
    }

    protected function displayHorizontalMenu()
    {
        ?>
        <div class="w-100 d-flex justify-content-center bg-primary">
            <nav style="max-width: 1377px;" class="w-100">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item border-right border-left">
                        <a class="nav-link text-white" href="/cars-comparer-2cs-project">Home</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="/cars-comparer-2cs-project/news">News</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="/cars-comparer-2cs-project/brands">Brands</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="/cars-comparer-2cs-project/compare">Comparator</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="#">Reviews</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="#">Buying guides</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php
    }

    protected function displayFooter()
    {
        ?>
        <footer class="bg-primary text-white mt-4">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="logo white-filter"
                            style="width: 12rem; object-fit: contain;" />
                        <p class="mt-4">
                            Discover your ideal ride with CarCompass – your ultimate destination for insightful car comparisons.
                            Navigate through an extensive database, explore detailed specs, and make informed decisions on the
                            perfect vehicle for your journey. Your trusted companion in the world of cars.
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4">Useful links</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="/cars-comparer-2cs-project" class="text-white">Home</a></li>
                            <li class="mb-2"><a href="#" class="text-white">News</a></li>
                            <li class="mb-2"><a href="/cars-comparer-2cs-project/brands" class="text-white">Brands</a></li>
                            <li class="mb-2"><a href="/cars-comparer-2cs-project/compare" class="text-white">Comparator</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Reviews</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Buying Guides</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <h6 class="text-uppercase font-weight-bold mb-4">Company</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-white">Terms of Use</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="py-2 px-4 fw-sm d-flex justify-content-end">
                <p>
                    ©
                    <?= date("Y") ?> CarCompass. All rights reserved.
                </p>
            </div>
        </footer>
        <?php
    }

    protected function displayComparator()
    {

        $brandController = new BrandController();
        $brands = $brandController->getBrands()["data"] ?? [];

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <div class="mt-5">
                <h2 class="head">Compare up to 4 vehicles </h2>
            </div>
            <div class="w-100 d-flex justify-content-center flex-column align-items-center bg-light  mt-4 p-4">
                <div id="message" class="w-100">
                </div>
                <div class="row w-100">
                    <div class="col-md-3 border-right">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 1);
                        ?>
                    </div>
                    <div class="col-md-3 border-right">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 2);
                        ?>
                    </div>
                    <div class="col-md-3 border-right">
                        <?php
                        $this->selectVehicleToCompareForm($brands, 3);
                        ?>
                    </div>
                    <div class="col-md-3">
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

    private function selectVehicleToCompareForm($brands, $index)
    {
        ?>
        <div style="overflow: hidden;">
            <img class="img-hover-transition" style="height: 10rem;object-fit: cover;width: 100%;"
                id="vehicle-image-<?= $index ?>" src="/cars-comparer-2cs-project/assets/images/vehicle-placeholder.png" />
        </div>
        <div class="form-group mt-4">
            <label>Brand:</label>
            <select onchange="onBrandChange(<?= $index ?>)" class="form-control" id="brand-<?= $index ?>" name="brand" required>
                <option value="">Select Brand</option>
                <?php
                foreach ($brands as $brand) {
                    ?>
                    <option value="<?php echo $brand["id"]; ?>">
                        <?php echo $brand["name"]; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Vehicle:</label>
            <select onchange="onVehicleChange(<?= $index ?>)" disabled class="form-control" id="vehicle-<?= $index ?>"
                name="brand" required>
                <option value="">Select Vehicle</option>
            </select>
        </div>
        <?php
    }

    protected function displayMostComparedCars()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light mt-4" style="height: 24rem;">
            <h1>Most Compared Cars</h1>
        </div>
        <?php
    }

    protected function displayVehicleSummaryDetails($vehicle)
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
                    <a href="/cars-comparer-2cs-project/vehicles?id=<?= $vehicle["id"]; ?>" class="btn btn-primary">Show
                        more</a>
                </div>
            </div>
        </div>
        <?php
    }
}
?>