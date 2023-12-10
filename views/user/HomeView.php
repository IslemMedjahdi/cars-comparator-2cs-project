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

    private function displayHorizontalMenu()
    {
        ?>
        <div class="w-100 d-flex justify-content-center bg-primary">
            <div style="max-width: 1377px;" class="w-100">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item border-right border-left">
                        <a class="nav-link text-white" href="/cars-comparer-2cs-project">Home</a>
                    </li>
                    <li class="nav-item border-right">
                        <a class="nav-link text-white" href="#">News</a>
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
            </div>
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
                    <a href="/cars-comparer-2cs-project/brand/<?php echo $brand["id"]; ?>"
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
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light mt-4" style="height: 24rem;">
            <h1>Comparator</h1>
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