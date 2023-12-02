<?php

require_once(__DIR__ . "/../models/BrandModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class BrandController
{
    public function createBrand()
    {

        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            echo json_encode(
                array(
                    'status' => 400,
                    'message' => "You must be an admin in to create a brand"
                )
            );
            return;
        }

        $brandModel = new BrandModel();

        $name = $_POST['name'];
        $countryOfOrigin = $_POST['countryOfOrigin'];
        $yearFounded = $_POST['yearFounded'];
        $websiteURL = $_POST['websiteURL'];
        $description = $_POST['description'];
        $logoImage = $_FILES['logoImage'];

        try {
            $brandModel->addBrand($name, $countryOfOrigin, $yearFounded, $websiteURL, $description, $logoImage);

            echo json_encode(
                array(
                    'status' => 200,
                    'message' => 'Brand created successfully'
                )
            );
        } catch (ErrorException $e) {
            echo json_encode(
                array(
                    'status' => 400,
                    'message' => $e->getMessage()
                )
            );
        }
    }
}
?>