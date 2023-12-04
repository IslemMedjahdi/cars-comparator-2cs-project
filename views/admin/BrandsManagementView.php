<?php

require_once __DIR__ . '/SharedAdminView.php';
require_once __DIR__ . '/../../controllers/BrandController.php';

class BrandsManagementView extends SharedAdminView
{
    public function displayCreateBrandPage()
    {
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <h3 class="head">Create Brand:</h3>
                            <div id="message"></div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="countryOfOrigin">Country of Origin:</label>
                                            <input type="text" class="form-control" id="countryOfOrigin" name="countryOfOrigin"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="yearFounded">Year Founded:</label>
                                            <input type="number" class="form-control" id="yearFounded" name="yearFounded"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="websiteURL">Website URL:</label>
                                            <input type="url" class="form-control" id="websiteURL" name="websiteURL">
                                        </div>
                                        <div class="form-group">
                                            <label for="logoImage">Logo:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logoImage" name="logoImage"
                                                    accept="image/*" required>
                                                <label class="custom-file-label" for="logoImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="/cars-comparer-2cs-project/admin/brands" class="btn btn-secondary">Back</a>
                                    <button onclick="createBrand()" class="btn btn-primary">Submit</button>
                                </div>
                                </d>
                            </div>
                </main>
            </div>
        </div>

        <?php
    }

    public function displayBrandsPage()
    {

        $brandsController = new BrandController();

        $response = $brandsController->getBrands();

        $brands = $response["data"];

        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="head">Brands</h3>
                                <a href="/cars-comparer-2cs-project/admin/brands/create" class="btn btn-primary">Create
                                    Brand</a>
                            </div>
                            <?php
                            $this->displayBrandsTable($brands)
                                ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        </div>
        <?php
        return;
    }


    private function displayBrandsTable($brands)
    {
        ?>
        <div class="table-responsive">
            <table class="table  bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Country of Origin</th>
                        <th scope="col">Year Founded</th>
                        <th scope="col">Website URL</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($brands as $brand) {
                        ?>
                        <tr>
                            <td>
                                <?= $brand["id"] ?>
                            </td>
                            <td>
                                <?= $brand["name"] ?>
                            </td>
                            <td>
                                <?= $brand["CountryOfOrigin"] ?>
                            </td>
                            <td>
                                <?= $brand["YearFounded"] ?>
                            </td>
                            <td>
                                <?php
                                if ($brand["WebsiteURL"] != null) {
                                    ?>
                                    <a href="<?= $brand["WebsiteURL"] ?>">
                                        <?= $brand["WebsiteURL"] ?>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    N/A
                                    <?php
                                }
                                ?>
                            </td>
                            <td><img src="/cars-comparer-2cs-project<?= $brand["LogoImageURL"] ?>" class="logo" /></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="/cars-comparer-2cs-project/admin/brands/edit?id=<?= $brand["id"] ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                    <button onclick="deleteBrand(<?= $brand["id"] ?>)" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php


    }
}
?>