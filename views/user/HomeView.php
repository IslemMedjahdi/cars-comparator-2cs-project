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
        $settingsController = new SettingsController();

        $diaporamaItems = $settingsController->getDiaporamaItems()["data"] ?? [];
        ?>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($diaporamaItems as $key => $diaporamaItem) { ?>
                    <li style="cursor: pointer;" data-target="#carouselExampleSlidesOnly" data-slide-to="<?= $key; ?>"
                        class="<?= $key == 0 ? "active" : ""; ?>"></li>
                <?php } ?>
            </ol>
            <div style="position: relative;" class="carousel-inner">
                <?php foreach ($diaporamaItems as $key => $diaporamaItem) { ?>
                    <div class="carousel-item <?= $key == 0 ? "active" : ""; ?>">
                        <div style="position: absolute;bottom: 5rem;left: 5rem;">
                            <a class="fancy" href="<?= $diaporamaItem["url"]; ?>" target="_blank">
                                <span class="top-key"></span>
                                <span class="text">Read More</span>
                                <span class="bottom-key-1"></span>
                                <span class="bottom-key-2"></span>
                            </a>
                        </div>
                        <img src="/cars-comparer-2cs-project/<?= $diaporamaItem["image"]; ?>" class="d-block w-100"
                            style="height: 30rem;object-fit: cover;object-position: center;pointer-events: none"
                            alt="<?= $key . "-carousel" ?>">
                    </div>
                <?php } ?>
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




    private function displayLinkToBuyingGuid()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center bg-light mt-4" style="height: 24rem;position: relative;">
            <img src="/cars-comparer-2cs-project/assets/images/buying-guide-bg.jpg" alt="buying-guide" class="w-100 "
                style="height: 25rem;object-fit: cover; object-position: center;filter: blur(2px);">
            <div style="position: absolute;bottom: 5rem;left: 5rem;" class="d-flex flex-column align-items-start gap-2">
                <h1 style="color: white;font-weight: bold;">
                    Buying Guide
                </h1>
                <a class="fancy" href="/cars-comparer-2cs-project/buying-guide">
                    <span class="top-key"></span>
                    <span class="text">Read More</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
            </div>
        </div>
        <?php
    }



}
?>