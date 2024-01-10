<?php

require_once('Connection.php');
class BrandReviewModel extends Connection
{

    public function addReview($userId, $brandId, $rate, $review = null)
    {
        $status = 'pending';

        if (empty($userId)) {
            throw new Exception("User Id cannot be empty");
        }

        if (empty($brandId)) {
            throw new Exception("Brand Id cannot be empty");
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
            $sql = "INSERT INTO brand_review (userId,brandId,rate,review,status) VALUES (:userId,:brandId,:rate,:review,:status) ON DUPLICATE KEY UPDATE rate=:rate,review=:review,status=:status";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'userId' => $userId,
                'brandId' => $brandId,
                'rate' => $rate,
                'review' => $review,
                'status' => $status
            ]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewOfUserByBrandId($userId, $brandId)
    {
        if (empty($userId)) {
            throw new Exception("User Id cannot be empty");
        }

        if (empty($brandId)) {
            throw new Exception("Brand Id cannot be empty");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM brand_review WHERE userId=:userId AND brandId=:brandId";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'userId' => $userId,
                'brandId' => $brandId
            ]);

            $review = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $review;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewsByBrandId($brandId, $page = 1, $perPage = 5)
    {

        if (empty($brandId)) {
            throw new Exception("brand Id cannot be empty");
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


            $sql = "SELECT br.*, u.username 
                FROM brand_review br
                INNER JOIN user u ON br.userId = u.id
                WHERE br.brandId=:brandId AND br.status='accepted' 
                ORDER BY br.rate DESC
                LIMIT $perPage OFFSET $offset";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'brandId' => $brandId
            ]);

            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $reviews;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewsCountByBrandId($brandId)
    {
        if (empty($brandId)) {
            throw new Exception("Brand Id cannot be empty");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM brand_review WHERE brandId=:brandId AND status='accepted'";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'brandId' => $brandId
            ]);

            $count = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $count;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviews()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT br.*, u.username, b.name as brandName
                FROM brand_review br
                INNER JOIN user u ON br.userId = u.id
                INNER JOIN brand b ON br.brandId = b.id
                ORDER BY br.status DESC";


            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $reviews;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getReviewsCount()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM brand_review";

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $count = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $count;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function accepteReview($brandId, $userId)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM brand_review WHERE brandId=:brandId AND userId=:userId AND status='pending'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'brandId' => $brandId,
                'userId' => $userId
            ]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);
            if ($result) {
                try {
                    $sql = "UPDATE brand_review SET status='accepted' WHERE brandId=:brandId AND userId=:userId";

                    $stmt = $pdo->prepare($sql);

                    $stmt->execute([
                        'brandId' => $brandId,
                        'userId' => $userId
                    ]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new Exception($e->getMessage());
                }
            } else {
                throw new Exception("Review not found");
            }

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function blockReview($brandId, $userId)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM brand_review WHERE brandId=:brandId AND userId=:userId AND status='pending' OR status='accepted'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'brandId' => $brandId,
                'userId' => $userId
            ]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);
            if ($result) {
                try {
                    $sql = "UPDATE brand_review SET status='blocked' WHERE brandId=:brandId AND userId=:userId";

                    $stmt = $pdo->prepare($sql);

                    $stmt->execute([
                        'brandId' => $brandId,
                        'userId' => $userId
                    ]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new Exception($e->getMessage());
                }
            } else {
                throw new Exception("Review not found");
            }

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function activateReview($brandId, $userId)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM brand_review WHERE brandId=:brandId AND userId=:userId AND status='blocked'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'brandId' => $brandId,
                'userId' => $userId
            ]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);
            if ($result) {
                try {
                    $sql = "UPDATE brand_review SET status='accepted' WHERE brandId=:brandId AND userId=:userId";

                    $stmt = $pdo->prepare($sql);

                    $stmt->execute([
                        'brandId' => $brandId,
                        'userId' => $userId
                    ]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new Exception($e->getMessage());
                }
            } else {
                throw new Exception("Review not found");
            }

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getBestReviewsOfBrand($brandId)
    {

        if (empty($brandId)) {
            throw new Exception("Brand Id cannot be empty");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT br.*, u.username 
                FROM brand_review br
                INNER JOIN user u ON br.userId = u.id
                WHERE br.brandId=:brandId AND br.status='accepted' 
                ORDER BY br.rate DESC
                LIMIT 3";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'brandId' => $brandId
            ]);

            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $reviews;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

}

?>