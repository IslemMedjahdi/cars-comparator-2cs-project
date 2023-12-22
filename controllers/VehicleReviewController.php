<?php

require_once __DIR__ . '/../models/VehicleReviewModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class VehicleReviewController
{

    public function createReview()
    {

        $userId = SessionUtils::getSessionVariable('user')['id'] ?? null;
        $vehicleId = $_POST['vehicleId'] ?? null;
        $rate = $_POST['rate'] ?? null;
        $review = $_POST['review'] ?? null;
        try {
            $userModel = new UserModel();
            $user = $userModel->getUserById($userId);

            if ($user['status'] != 'accepted') {
                throw new Exception("You cannot add review because you are blocked");
            }

            $vehicleReviewModel = new VehicleReviewModel();
            $vehicleReviewModel->addReview($userId, $vehicleId, $rate, $review);

            if ($review == null) {
                return array(
                    'status' => 200,
                    'message' => "Your review has been added"
                );
            }

            return array(
                'status' => 200,
                'message' => "Your review will be added after admin approval"
            );
        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getReviewOfUserByVehicleId($vehicleId)
    {
        $vehicleReviewModel = new VehicleReviewModel();

        $userId = SessionUtils::getSessionVariable('user')['id'] ?? null;

        try {
            $review = $vehicleReviewModel->getReviewOfUserByVehicleId($userId, $vehicleId);

            return array(
                'status' => 200,
                'data' => $review
            );

        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getReviewsByVehicleId($vehicleId)
    {
        $vehicleReviewModel = new VehicleReviewModel();

        $page = $_GET['page'] ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        try {
            $reviews = $vehicleReviewModel->getReviewsByVehicleId($vehicleId, $page);

            $totalPages = ceil($vehicleReviewModel->getReviewsCountByVehicleId($vehicleId) / 10);


            return array(
                'status' => 200,
                'data' => $reviews,
                'totalPages' => $totalPages,
                'currentPage' => $page
            );

        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

}
?>