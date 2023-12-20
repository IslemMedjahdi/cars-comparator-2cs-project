<?php
require_once __DIR__ . '/SharedAdminView.php';
require_once __DIR__ . '/../../controllers/brandController.php';
require_once __DIR__ . '/../../controllers/vehicleController.php';

class VehiclesManagementView extends SharedAdminView
{
    public function displayCreateVehiclePage()
    {
        $brandsController = new BrandController();
        $brands = $brandsController->getBrands()["data"];

        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <h3 class="head">Create Vehicle:</h3>
                            <div id="message"></div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand:</label>
                                            <select class="form-control" id="brand" name="brand" required>
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
                                            <label for="name">Model:</label>
                                            <input type="text" class="form-control" id="model" name="model" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="engine">Engine:</label>
                                            <input type="text" class="form-control" id="engine" name="engine" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="year">Year:</label>
                                            <input type="number" class="form-control" id="year" name="year" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="version">Version:</label>
                                            <input type="text" class="form-control" id="version" name="version" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="speed">Speed:</label>
                                            <input type="number" class="form-control" id="speed" name="speed" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="acceleration">Acceleration (0-100 km/h):</label>
                                            <input type="number" class="form-control" id="acceleration" name="acceleration"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fuel Type:</label>
                                            <select class="form-control" id="fuel_type" name="fuel_type" required>
                                                <option value="">Select Fuel Type</option>
                                                <option value="gasoline">Gasoline</option>
                                                <option value="diesel">Diesel</option>
                                                <option value="electric">Electric</option>
                                                <option value="hybrid">Hybrid</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="consumption">Consumption:</label>
                                            <input type="number" class="form-control" id="consumption" name="consumption"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="height">Height:</label>
                                            <input type="number" class="form-control" id="height" name="height" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="width">Width:</label>
                                            <input type="number" class="form-control" id="width" name="width" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="length">Length:</label>
                                            <input type="number" class="form-control" id="length" name="length" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Image">Image:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Image" name="Image"
                                                    accept="image/*" required>
                                                <label class="custom-file-label" for="Image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pricing_range_from">Pricing From:</label>
                                            <input type="number" class="form-control" id="pricing_range_from"
                                                name="pricing_range_from" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pricing_range_to">Pricing To:</label>
                                            <input type="number" class="form-control" id="pricing_range_to"
                                                name="pricing_range_to" required>
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
                                    <a href="/cars-comparer-2cs-project/admin/vehicles" class="btn btn-secondary">Back</a>
                                    <button onclick="createVehicle()" class="btn btn-primary"><i class="bi bi-plus-circle"></i>
                                        Submit</button>
                                </div>
                                </d>
                            </div>
                </main>
            </div>
        </div>

        <?php
    }

    public function displayVehiclesPage()
    {
        $vehicleController = new VehicleController();

        $response = $vehicleController->getVehicles();

        $vehicles = $response["data"];

        $currentPage = $response["currentPage"];

        $totalPages = $response["totalPages"];


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
                                <h3 class="head">Vehicles</h3>
                                <a href="/cars-comparer-2cs-project/admin/vehicles/create" class="btn btn-primary"><i
                                        class="bi bi-plus-circle"></i> Create
                                    Vehicle</a>
                            </div>
                            <?php
                            $this->displayVehiclesTable($vehicles);
                            ?>
                            <div class="d-flex justify-content-center">
                                <?php
                                $this->displayVehicleTablePagination($totalPages, $currentPage);
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php

    }

    private function displayVehiclesTable($vehicles)
    {
        ?>

        <div class="table-responsive">
            <table class="table  bg-white">
                <thead class="thead-dark">
                    <tr>

                        <th scope="col">ID</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Version</th>
                        <th scope="col">Year</th>
                        <th scope="col">Speed</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehicles as $vehicle) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $vehicle["id"]; ?>
                            </th>
                            <td>
                                <?php echo $vehicle["brand_name"]; ?>
                            </td>
                            <td>
                                <div class="badge badge-pill badge-primary">
                                    <?php echo $vehicle["model"]; ?>
                                </div>
                            </td>
                            <td>
                                <?php echo $vehicle["version"]; ?>
                            </td>
                            <td>
                                <?php echo $vehicle["year"]; ?>
                            </td>
                            <td>
                                <?php echo $vehicle["speed"] ?>
                                <span class="unit">KM/h</span>
                            </td>
                            <td>
                                <div class="badge badge-pill badge-primary">
                                    <?php echo $vehicle["fuel_type"]; ?>
                                </div>
                            </td>


                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/cars-comparer-2cs-project/admin/vehicles/edit?id=<?php echo $vehicle["id"]; ?>"
                                        class="btn btn-primary">Edit</a>
                                    <button onclick="deleteVehicle(<?php echo $vehicle["id"]; ?>)"
                                        class="btn btn-danger">Delete</button>
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

    private function displayVehicleTablePagination($totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?php echo $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/admin/vehicles?page=<?php echo $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?php echo $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/admin/vehicles?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?php echo $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/admin/vehicles?page=<?php echo $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php
    }

}
?>