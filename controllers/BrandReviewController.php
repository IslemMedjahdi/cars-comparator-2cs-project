<?php

require_once __DIR__ . '/../models/BrandReviewModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class BrandReviewController
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

        $brandId = $_POST['brandId'] ?? null;
        $rate = $_POST['rate'] ?? null;
        $review = $_POST['review'] ?? null;
        try {
            $brandReviewModel = new BrandReviewModel();
            $brandReviewModel->addReview($userId, $brandId, $rate, $review);

            if ($user['role'] == 'admin') {
                $brandReviewModel->accepteReview($brandId, $userId);
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

    public function getReviewOfUserByBrandId($brandId)
    {
        $brandReviewModel = new BrandReviewModel();

        $userId = SessionUtils::getSessionVariable('user')['id'] ?? null;

        try {
            $review = $brandReviewModel->getReviewOfUserByBrandId($userId, $brandId);

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

    public function getReviewsByBrandId($brandId)
    {
        $brandReviewModel = new BrandReviewModel();

        $page = $_GET['page'] ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        try {
            $reviews = $brandReviewModel->getReviewsByBrandId($brandId, $page);

            $totalPages = ceil($brandReviewModel->getReviewsCountByBrandId($brandId) / 10);


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

        $brandReviewsModel = new BrandReviewModel();

        $page = $_GET['page'] ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        $perPage = 10;

        try {
            $reviews = $brandReviewsModel->getReviews($page, $perPage);

            $totalPages = ceil($brandReviewsModel->getReviewsCount() / $perPage);

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
                'message' => "You must be an admin to create a brand"
            );
        }
        $brandId = $_POST['brandId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $brandReviewModel = new BrandReviewModel();

        try {
            $brandReviewModel->accepteReview($brandId, $userId);

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
                'message' => "You must be an admin to create a brand"
            );
        }
        $brandId = $_POST['brandId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $brandReviewModel = new BrandReviewModel();

        try {
            $brandReviewModel->blockReview($brandId, $userId);

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
                'message' => "You must be an admin to create a brand"
            );
        }
        $brandId = $_POST['brandId'] ?? null;
        $userId = $_POST['userId'] ?? null;

        $brandReviewModel = new BrandReviewModel();

        try {
            $brandReviewModel->activateReview($brandId, $userId);

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

    public function getBestReviewsOfBrand($brandId)
    {

        $brandReviewModel = new BrandReviewModel();

        try {
            $reviews = $brandReviewModel->getBestReviewsOfBrand($brandId);

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