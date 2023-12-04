<?php

require_once __DIR__ . '/SharedAdminView.php';
require_once __DIR__ . '/../../controllers/BrandController.php';

class BrandsManagementView extends SharedAdminView
{
    public function displayCreateBrandPage()
    {
        $this->displaySideBar(<<<HTML
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
                                    <input type="text" class="form-control" id="countryOfOrigin" name="countryOfOrigin" required>
                                </div>

                                <div class="form-group">
                                    <label for="yearFounded">Year Founded:</label>
                                    <input type="number" class="form-control" id="yearFounded" name="yearFounded" required>
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
                                        <input type="file" class="custom-file-input" id="logoImage" name="logoImage" accept="image/*" required>
                                        <label class="custom-file-label" for="logoImage">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/cars-comparer-2cs-project/admin/brands" class="btn btn-secondary">Back</a>
                            <button onclick="createBrand()" class="btn btn-primary">Submit</button>
                        </div>
                    </d>
                </div>
            </div>
            HTML);
    }

    public function displayBrandsPage()
    {

        $brandsController = new BrandController();

        $response = $brandsController->getBrands();


        if ($response["status"] === 200) {
            $brands = $response["data"];

            $brandsTable = $this->getBrandsTable($brands);


            $this->displaySideBar(
                <<<HTML
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <div class="d-flex justify-content-between align-items-center">
                              <h3 class="head">Brands</h3>
                              <a href="/cars-comparer-2cs-project/admin/brands/create" class="btn btn-primary">Create Brand</a>
                            </div>
                            $brandsTable
                        <div>
                    </div>
                    HTML
            );
            return;
        }

        $this->displaySideBar(
            <<<HTML
                <h2>Brands</h2>
                <div class="alert alert-danger" role="alert">
                    Error loading brands!
                </div>
                HTML
        );
    }

    private function getBrandsTable($brands)
    {
        $html = "<div class=\"table-responsive\">";
        $html .= "<table class=\"table  bg-white\">";
        $html .= "<thead class=\"thead-dark\">";
        $html .= "<tr>";
        $html .= "<th scope=\"col\">ID</th>";
        $html .= "<th scope=\"col\">Name</th>";
        $html .= "<th scope=\"col\">Country of Origin</th>";
        $html .= "<th scope=\"col\">Year Founded</th>";
        $html .= "<th scope=\"col\">Website URL</th>";
        $html .= "<th scope=\"col\">Logo</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";

        foreach ($brands as $brand) {
            $html .= "<tr>";
            $html .= "<td>" . $brand["id"] . "</td>";
            $html .= "<td>" . $brand["name"] . "</td>";
            $html .= "<td>" . $brand["CountryOfOrigin"] . "</td>";
            $html .= "<td>" . $brand["YearFounded"] . "</td>";
            $html .= "<td>";
            if ($brand["WebsiteURL"] != null) {
                $html .= "<a href=\"" . $brand["WebsiteURL"] . "\">" . $brand["WebsiteURL"] . "</a>";
            } else {
                $html .= "N/A";
            }
            $html .= "</td>";
            $html .= "<td><img src=\"/cars-comparer-2cs-project" . $brand["LogoImageURL"] . "\" class=\"logo\" ></td>";
            $html .= "</tr>";
        }

        $html .= "</tbody>";

        $html .= "</table>";
        $html .= "</div>";
        return $html;
    }
}
?>