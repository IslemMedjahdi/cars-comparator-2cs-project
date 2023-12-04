<?php

require_once(__DIR__ . "/../models/BrandModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class BrandController
{
    public function createBrand()
    {

        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin in to create a brand"
            );
        }

        $brandModel = new BrandModel();

        $name = $_POST['name'] ?? null;
        $countryOfOrigin = $_POST['countryOfOrigin'] ?? null;
        $yearFounded = $_POST['yearFounded'] ?? null;
        $websiteURL = $_POST['websiteURL'] ?? null;
        $description = $_POST['description'] ?? null;
        $logoImage = $_FILES['logoImage'] ?? null;

        try {
            $brandModel->addBrand($name, $countryOfOrigin, $yearFounded, $websiteURL, $description, $logoImage);

            return array(
                'status' => 200,
                'message' => 'Brand created successfully'
            );

        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );

        }
    }

    public function getBrands()
    {
        $brandModel = new BrandModel();

        try {
            $brands = $brandModel->getBrands();

            return array(
                'status' => 200,
                'data' => $brands
            );

        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function deleteBrand()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin in to delete a brand"
            );
        }

        $brandModel = new BrandModel();

        $id = $_POST['id'] ?? null;

        try {
            $brandModel->deleteBrand($id);

            return array(
                'status' => 200,
                'message' => 'Brand deleted successfully'
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