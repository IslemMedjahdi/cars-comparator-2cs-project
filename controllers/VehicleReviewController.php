<?php
class VehicleReviewController
{

    public function createReview()
    {
        $vehicleReviewModel = new VehicleReviewModel();

        $userId = SessionUtils::getSessionVariable('user')['id'] ?? null;
        $vehicleId = $_POST['vehicleId'] ?? null;
        $rate = $_POST['rate'] ?? null;
        $review = $_POST['review'] ?? null;
        try {

            $vehicleReviewModel->addReview($userId, $vehicleId, $rate, $review);

            return array(
                'status' => 200,
                'message' => "Review added successfully"
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