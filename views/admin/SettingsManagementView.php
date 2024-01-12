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
                    <div id="message"></div>
                    <div class="d-flex justify-content-center w-100">
                        <?php
                        $this->displayUpdateStyles($primaryColor);
                        $this->displayUpdateContact();
                        $this->displayUpdateContent();
                        $this->displayDiaporamaSettings();
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
            <div class="container mt-5">
                <h3 class="head">Update Contact:</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= $contacts["email"] ?>" required>
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
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?= $contacts["address"] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button onclick="updateContact()" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                        Submit</button>
                </div>
            </div>
            <?php
    }

    private function displayUpdateContent()
    {
        $settingsController = new SettingsController();

        $content = $settingsController->getContent()["data"];

        ?>
            <div class="container mt-5">
                <h3 class="head">Update Content:</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title" value="<?= $content["title"] ?>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="description">Description:</label>
                        <div class="input-group">
                            <textarea class="form-control" id="description" name="description" rows="5"
                                required><?= $content["description"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="buying_guide">Buying Guide:</label>
                        <div class="input-group">
                            <textarea class="form-control" id="buying_guide" name="buying_guide" rows="5"
                                required><?= $content["buying_guide"] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center mt-2">
                    <button onclick="updateContent()" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                        Submit</button>
                </div>
            </div>
            <?php
    }

    private function displayUpdateSocialMedia()
    {
        $settingsController = new SettingsController();

        $socialMedia = $settingsController->getSocialMedia()["data"];

        $facebook = $socialMedia["facebook_url"] ?? "";

        ?>
            <div class="container mt-5">
                <h3 class="head">Update Social Media:</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="facebook">Facebook:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $facebook ?>"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
    }

    private function displayDiaporamaSettings()
    {
        ?>
            <div class="container mt-5">
                <h3 class="head">Diaporama:</h3>
                <?php
                $this->displayAddNewDiaporamaItem();
                $this->displayDiaporamaItems();
                ?>
            </div>
            <?php
    }

    private function displayDiaporamaItems()
    {
        $settingsController = new SettingsController();

        $diaporamaItems = $settingsController->getDiaporamaItems()["data"] ?? [];

        ?>
            <div class="container mt-2 w-100">
                <table data-toggle="table" class="bg-white">
                    <thead>
                        <tr>
                            <th data-sortable="true" scope="col">URL</th>
                            <th data-sortable="true" scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($diaporamaItems as $diaporamaItem) {
                            ?>
                            <tr>
                                <td>
                                    <a href="<?= $diaporamaItem["url"] ?>" target="_blank">
                                        <?= $diaporamaItem["url"] ?>
                                    </a>
                                </td>
                                <td><img src="/cars-comparer-2cs-project/<?= $diaporamaItem["image"] ?>" alt="" width="200px"></td>
                                <td>
                                    <button onclick="deleteDiaporamaItem(<?= $diaporamaItem["id"] ?>)" class="btn btn-danger"><i
                                            class="bi bi-trash-fill"></i></button>
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

    private function displayAddNewDiaporamaItem()
    {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Image">Image:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Image" name="Image" accept="image/*" required>
                            <label class="custom-file-label" for="Image">Choose file</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <button onclick="addDiaporama()" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                            Submit</button>
                    </div>
                </div>
            </div>
            <?php
    }


}
?>