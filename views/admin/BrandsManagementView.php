<?php

require_once __DIR__ . '/SharedAdminView.php';

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
                        <button onclick="createBrand()" class="btn btn-primary">Submit</button>
                    </d>
                </div>
            </div>
            HTML);
    }

    public function displayBrandsPage()
    {
        $this->displaySideBar(
            <<<HTML
                <h2>Brands</h2>
                HTML
        );

    }
}
?>