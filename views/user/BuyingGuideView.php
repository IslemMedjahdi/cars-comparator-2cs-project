<?php
require_once __DIR__ . "/SharedUserView.php";

require_once __DIR__ . "/../../controllers/VehicleReviewController.php";
require_once __DIR__ . "/../../controllers/SettingsController.php";

class BuyingGuideView extends SharedUserView
{
    public function displayBuyingGuidePage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayBuyingGuide();
        $this->displayVehicles();
        $this->displayFooter();
    }

    private function displayBuyingGuide()
    {
        $settingsController = new SettingsController();

        $buyingGuide = $settingsController->getBuyingGuide()["data"] ?? "";

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Buying Guide</h2>
            </div>

            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div class="bg-light p-4 border">
                    <p style="white-space: pre-wrap;">
                        <?= $buyingGuide; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayVehicles()
    {
        $vehicleController = new VehicleController();

        $response = $vehicleController->getVehicles();

        $vehicles = $response["data"] ?? [];

        $totalPages = $response["totalPages"] ?? 1;

        $currentPage = $response["currentPage"] ?? 1;

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Vehicles</h2>
            </div>
            <div class="w-100 mt-4 row" style="max-width: 1377px;row-gap: 1rem;">
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
    }



    private function displayVehiclesListPagination($totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/buying-guide?page=<?= $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/buying-guide?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link" href="/cars-comparer-2cs-project/buying-guide?page=<?= $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php
    }
}
?>