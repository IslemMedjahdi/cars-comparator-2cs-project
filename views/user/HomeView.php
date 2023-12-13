<?php
require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . '/../../controllers/BrandController.php';

class HomeView extends SharedUserView
{

    public function displayHomePage()
    {
        ?>
        <?php
        $this->displayHeader();
        $this->displayDiaporama();
        $this->displayHorizontalMenu();
        $this->displayBrands();
        $this->displayComparator();
        $this->displayLinkToBuyingGuid();
        $this->displayMostComparedCars();
        $this->displayFooter();
    ?>
    <?php
    }

    private function displayDiaporama()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 24rem;">
            <h1>Diaporama</h1>
        </div>
        <?php
    }



    private function displayBrands()
    {
        $brandController = new BrandController();

        $brands = $brandController->getBrands()["data"] ?? [];

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Brands</h2>
            </div>
            <div class="row w-100 mt-4" style="max-width: 1377px;">
                <?php foreach ($brands as $brand) { ?>
                    <a href="/cars-comparer-2cs-project/brands?id=<?php echo $brand["id"]; ?>"
                        class="col-md-3 bg-light border d-flex justify-content-center align-items-center"
                        style="width: 5rem;height: 5rem;">
                        <img class="logo" src="/cars-comparer-2cs-project/<?php echo $brand["LogoImageURL"]; ?>"
                            alt="<?php echo $brand["name"]; ?>">
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    private function displayComparator()
    {

        $brandController = new BrandController();
        $brands = $brandController->getBrands()["data"] ?? [];

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <div class="mt-5">
                <h2 class="head">Compare up to 4 vehicles </h2>
            </div>
            <div class="w-100 d-flex justify-content-center flex-column align-items-center bg-light  mt-4 p-4">
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
        <div class="form-group">
            <div id="vehicle-logo-<?= $index ?>">

            </div>
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
            <select disabled class="form-control" id="vehicle-<?= $index ?>" name="brand" required>
                <option value="">Select Vehicle</option>
            </select>
        </div>
        <?php
    }


    private function displayLinkToBuyingGuid()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light mt-4" style="height: 24rem;">
            <h1>Link to Buying Guide</h1>
        </div>
        <?php
    }

    private function displayMostComparedCars()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light mt-4" style="height: 24rem;">
            <h1>Most Compared Cars</h1>
        </div>
        <?php
    }

}
?>