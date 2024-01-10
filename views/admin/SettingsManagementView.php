<?php
require_once(__DIR__ . "/../../controllers/SettingsController.php");
require_once(__DIR__ . "/SharedAdminView.php");

class SettingsManagementView extends SharedAdminView
{

    public function displaySettingsPage()
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
                        <?php
                        $this->displayUpdateStyles($primaryColor);
                        $this->displayUpdateContact();
                        ?>

                    </div>
                </main>
            </div>
        </div>
        <?php
    }

    private function displayUpdateStyles($primaryColor)
    {
        ?>
        <div class="container mt-5">
            <h3 class="head">Update Styles:</h3>
            <div id="message"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Logo">Logo:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="Logo" accept="image/*" required>
                            <label class="custom-file-label" for="Logo">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="favicon">Favicon:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="favicon" name="favicon" accept="image/*" required>
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
            <?php
    }

    private function displayUpdateContact()
    {
        $settingsController = new SettingsController();

        $contacts = $settingsController->getContact()["data"];

        ?>
            <h3 class="head">Update Contact:</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $contacts["email"] ?>"
                                required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="phone_number">Phone Number:</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="phone_number" name="phone_number"
                            value="<?= $contacts["phone_number"] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="address">Address:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="address" name="address" value="<?= $contacts["address"] ?>"
                            required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <button onclick="updateContact()" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                    Submit</button>
            </div>
            <?php
    }

}
?>