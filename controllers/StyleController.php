<?php

require_once(__DIR__ . "/../models/StyleModel.php");

class StyleController
{

    public function updateStyles()
    {
        $styleModel = new StyleModel();

        $logo = $_FILES['logo'] ?? null;
        $favicon = $_FILES['favicon'] ?? null;
        $primaryColor = $_POST['primaryColor'] ?? null;
        $facebook = $_POST['facebook'] ?? null;
        $linkedin = $_POST['linkedin'] ?? null;
        $instagram = $_POST['instagram'] ?? null;



        try {

            $styleModel->updateStyles($logo, $favicon, $primaryColor, $facebook, $linkedin, $instagram);

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
        $styleModel = new StyleModel();

        try {
            $result = $styleModel->getLogo();

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
        $styleModel = new StyleModel();

        try {
            $result = $styleModel->getFavicon();

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
        $styleModel = new StyleModel();

        try {
            $result = $styleModel->getPrimaryColor();

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
        $styleModel = new StyleModel();

        try {
            $result = $styleModel->getSocialMedia();

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


}
?>