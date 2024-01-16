<?php

require_once('Connection.php');

class NewsModel extends Connection
{

    public function addNews($title, $description, $Image)
    {
        if (empty($title)) {
            throw new ErrorException("Title is required");
        }
        if (empty($description)) {
            throw new ErrorException("Description is required");
        }
        if (isset($Image) && $Image['error'] === 0) {
            $ImageURL = $this->uploadImage($Image, "/news");
        } else {
            throw new ErrorException("Image is required");
        }

        $pdo = $this->connect();
        $sql = "INSERT INTO news (title, description, ImageURL) VALUES (:title, :description, :ImageURL)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'ImageURL' => $ImageURL
        ]);
        return $stmt->rowCount();
    }

    public function getNews()
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM news";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNewsById($id)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function deleteNews($id)
    {
        $pdo = $this->connect();
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function updateNews($id, $title, $description, $Image)
    {
        if (empty($title)) {
            throw new ErrorException("Title is required");
        }
        if (empty($description)) {
            throw new ErrorException("Description is required");
        }

        $existingVehicle = $this->getNewsById($id);

        if (!$existingVehicle) {
            throw new ErrorException("News not found");
        }

        $ImageURL = $existingVehicle['ImageURL'];

        if (isset($Image) && $Image['error'] === 0) {
            $ImageURL = $this->uploadImage($Image, "/news");
        }

        $pdo = $this->connect();
        $sql = "UPDATE news SET title = :title, description = :description, ImageURL = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'image' => $ImageURL,
            'id' => $id
        ]);
        return $stmt->rowCount();
    }



}
?>