<?php

require_once __DIR__ . '/../models/VehicleReviewModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class VehicleReviewController
{

    public function createReview()
    {

        $user = SessionUtils::getSessionVariable('user');

        if ($user == null) {
            throw new Exception("You must be logged in to add a review");
        }

        try {
            $userModel = new UserModel();
            $user = $userModel->getUserById($user['id']);

            if ($user['status'] != 'accepted') {
                return array(
                    'status' => 400,
                    'message' => "You are blocked"
                );
            }

        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }


        $userId = $user['id'] ?? null;

        $vehicleId = $_POST['vehicleId'] ?? null;
        $rate = $_POST['rate'] ?? null;
        $review = $_POST['review'] ?? null;
        try {
            $vehicleReviewModel = new VehicleReviewModel();
            $vehicleReviewModel->addReview($userId, $vehicleId, $rate, $review);

            if ($user['role'] == 'admin') {
                $vehicleReviewModel->accepteReview($vehicleId, $userId);
                return array(
                    'status' => 200,
                    'message' => "Review has been added"
                );
            }

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

    public function getReviews()
    {

        $vehicleReviewsModel = new VehicleReviewModel();

        $page = $_GET['page'] ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        $perPage = 10;

        try {
            $reviews = $vehicleReviewsModel->getReviews($page, $perPage);

            $totalPages = ceil($vehicleReviewsModel->getReviewsCount() / $perPage);

            return array(
                'status' => 200,
                'data' => $reviews,
                'totalPages' => $totalPages,
                'currentPage' => $page
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function accepteReview()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a vehicle"
            );
        }
        $vehicleId = $_POST['vehicleId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $vehicleReviewModel = new VehicleReviewModel();

        try {
            $vehicleReviewModel->accepteReview($vehicleId, $userId);

            return array(
                'status' => 200,
                'message' => "Review has been accepted"
            );
        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function blockReview()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a vehicle"
            );
        }
        $vehicleId = $_POST['vehicleId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $vehicleReviewModel = new VehicleReviewModel();

        try {
            $vehicleReviewModel->blockReview($vehicleId, $userId);

            return array(
                'status' => 200,
                'message' => "Review has been blocked"
            );
        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function activateReview()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a vehicle"
            );
        }
        $vehicleId = $_POST['vehicleId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $vehicleReviewModel = new VehicleReviewModel();

        try {
            $vehicleReviewModel->activateReview($vehicleId, $userId);

            return array(
                'status' => 200,
                'message' => "Review has been activated"
            );
        } catch (Exception $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getBestReviewsOfVehicle($vehicleId)
    {

        $vehicleReviewModel = new VehicleReviewModel();

        try {
            $reviews = $vehicleReviewModel->getBestReviewsOfVehicle($vehicleId);

            return array(
                'status' => 200,
                'data' => $reviews
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