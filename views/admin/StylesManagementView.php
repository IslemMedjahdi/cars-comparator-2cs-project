<?php
require_once(__DIR__ . "/../../controllers/StyleController.php");

class StylesManagementView extends SharedAdminView
{

    public function displayUpdateStylesPage()
    {
        $styleController = new StyleController();

        $logo = $styleController->getLogo();

        $favicon = $styleController->getFavicon();

        $primaryColor = $styleController->getPrimaryColor();

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