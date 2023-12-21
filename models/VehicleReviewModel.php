<?php

require_once('Connection.php');
class VehicleReviewModel extends Connection
{

    public function addReview($userId, $vehicleId, $rate, $review = null)
    {
        if (empty($userId)) {
            throw new Exception("User Id cannot be empty");
        }

        if (empty($vehicleId)) {
            throw new Exception("Vehicle Id cannot be empty");
        }

        if (empty($rate)) {
            throw new Exception("Rate cannot be empty");
        }

        if ($rate < 1 || $rate > 5) {
            throw new Exception("Rate must be between 1 and 5");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO vehicle_reviews (userId,vehicleId,rate,review) VALUES (:userId,:vehicleId,:rate,:review) ON DUPLICATE KEY UPDATE rate=:rate,review=:review";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'userId' => $userId,
                'vehicleId' => $vehicleId,
                'rate' => $rate,
                'review' => $review
            ]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

}

?>