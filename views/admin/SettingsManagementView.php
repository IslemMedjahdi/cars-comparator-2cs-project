<?php
require_once(__DIR__ . "/../../controllers/SettingsController.php");

class SettingsManagementView extends SharedAdminView
{

    public function displayUpdateStylesPage()
    {
        $settingsController = new SettingsController();

        $primaryColor = $settingsController->getPrimaryColor()["data"]["primary_color"] ?? "#007bff";

        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <h3 class="head">Update Styles:</h3>
                            <div id="message"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Logo">Logo:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="Logo" accept="image/*"
                                                required>
                                            <label class="custom-file-label" for="Logo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="favicon">Favicon:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="favicon" name="favicon"
                                                accept="image/*" required>
                                            <label class="custom-file-label" for="favicon">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="primaryColor">Primary Color:</label>
                                        <div class="input-group">
                                            <input type="color" class="form-control" id="primaryColor" name="primaryColor"
                                                value="<?= $primaryColor ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button onclick="updateStyles()" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                                    Submit</button>
                            </div>
                        </div>
                </main>
            </div>
        </div>
        <?php
    }

}
?>