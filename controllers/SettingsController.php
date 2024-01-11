<?php

require_once(__DIR__ . "/../models/SettingsModel.php");

class SettingsController
{

    public function updateStyles()
    {
        $settingsModel = new SettingsModel();

        $logo = $_FILES['logo'] ?? null;
        $favicon = $_FILES['favicon'] ?? null;
        $primaryColor = $_POST['primaryColor'] ?? null;
        $facebook = $_POST['facebook'] ?? null;
        $linkedin = $_POST['linkedin'] ?? null;
        $instagram = $_POST['instagram'] ?? null;



        try {

            $settingsModel->updateStyles($logo, $favicon, $primaryColor, $facebook, $linkedin, $instagram);

            return array(
                'status' => 200,
                'message' => "Styles updated successfully."
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getLogo()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getLogo();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function getFavicon()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getFavicon();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function getPrimaryColor()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getPrimaryColor();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function getSocialMedia()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getSocialMedia();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }

    }

    public function updateContact()
    {
        $settingsModel = new SettingsModel();

        $email = $_POST['email'] ?? null;
        $phoneNumber = $_POST['phoneNumber'] ?? null;
        $address = $_POST['address'] ?? null;

        try {
            $settingsModel->updateContent($email, $phoneNumber, $address);

            return array(
                'status' => 200,
                'message' => "Contact updated successfully."
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getContact()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getContact();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getContent()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getContent();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function updateContent()
    {
        $settingsModel = new SettingsModel();

        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;

        try {
            $settingsModel->updateContent(null, null, null, $title, $description);

            return array(
                'status' => 200,
                'message' => "Content updated successfully."
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function addDiaporamaItem()
    {

        $url = $_POST['url'] ?? null;
        $Image = $_FILES['image'] ?? null;

        $settingsModel = new SettingsModel();

        try {
            $settingsModel->addDiaporamaItem($url, $Image);

            return array(
                'status' => 200,
                'message' => "Diaporama added successfully."
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage(),
            );
        }
    }


    public function getDiaporamaItems()
    {
        $settingsModel = new SettingsModel();

        try {
            $result = $settingsModel->getDiaporamaItems();

            return array(
                'status' => 200,
                'data' => $result
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage(),
            );
        }
    }

    public function deleteDiaporamaItem()
    {
        $id = $_POST['id'] ?? null;

        $settingsModel = new SettingsModel();

        try {
            $settingsModel->deleteDiaporamaItem($id);

            return array(
                'status' => 200,
                'message' => "Diaporama item deleted successfully."
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage(),
            );
        }
    }
}
?>