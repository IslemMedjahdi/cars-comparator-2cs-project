<?php

require_once __DIR__ . "/../../controllers/BrandController.php";

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
                            <h1 class="font-weight-bold">
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

}

?>