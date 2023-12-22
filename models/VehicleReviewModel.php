<?php

require_once('Connection.php');
class VehicleReviewModel extends Connection
{

    public function addReview($userId, $vehicleId, $rate, $review = null)
    {
        $status = 'pending';

        if (empty($userId)) {
            throw new Exception("User Id cannot be empty");
        }

        if (empty($vehicleId)) {
            throw new Exception("Vehicle Id cannot be empty");
        }

        if (empty($rate)) {
            throw new Exception("Rate cannot be empty");
        }

        if (empty($review)) {
            $review = null;
            $status = 'accepted';
        }

        if ($rate < 1 || $rate > 5) {
            throw new Exception("Rate must be between 1 and 5");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO vehicle_review (userId,vehicleId,rate,review,status) VALUES (:userId,:vehicleId,:rate,:review,:status) ON DUPLICATE KEY UPDATE rate=:rate,review=:review,status=:status";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'userId' => $userId,
                'vehicleId' => $vehicleId,
                'rate' => $rate,
                'review' => $review,
                'status' => $status
            ]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewOfUserByVehicleId($userId, $vehicleId)
    {
        if (empty($userId)) {
            throw new Exception("User Id cannot be empty");
        }

        if (empty($vehicleId)) {
            throw new Exception("Vehicle Id cannot be empty");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM vehicle_review WHERE userId=:userId AND vehicleId=:vehicleId";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'userId' => $userId,
                'vehicleId' => $vehicleId
            ]);

            $review = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $review;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewsByVehicleId($vehicleId, $page = 1, $perPage = 5)
    {

        if (empty($vehicleId)) {
            throw new Exception("Vehicle Id cannot be empty");
        }

        if (empty($page)) {
            $page = 1;
        }

        if (empty($perPage)) {
            $perPage = 5;
        }

        $offset = ($page - 1) * $perPage;


        $pdo = $this->connect();

        try {


            $sql = "SELECT vr.*, u.username 
                FROM vehicle_review vr
                INNER JOIN user u ON vr.userId = u.id
                WHERE vr.vehicleId=:vehicleId AND vr.status='accepted' 
                ORDER BY vr.rate DESC
                LIMIT $perPage OFFSET $offset";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'vehicleId' => $vehicleId
            ]);

            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $reviews;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewsCountByVehicleId($vehicleId)
    {
        if (empty($vehicleId)) {
            throw new Exception("Vehicle Id cannot be empty");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM vehicle_review WHERE vehicleId=:vehicleId AND status='accepted'";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'vehicleId' => $vehicleId
            ]);

            $count = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $count;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

}

?>