<?php
class Connection
{
    private $config;

    public function __construct()
    {
        $this->config = require(__DIR__ . "/../config.php");
    }

    protected function connect()
    {
        try {
            $connection = new PDO("mysql:host={$this->config['server']};dbname={$this->config['dbname']};charset=utf8", $this->config['db_user'], $this->config['db_pass']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;
        } catch (PDOException $e) {
            exit;
        }
    }

    protected function request($connection, $query)
    {
        return $connection->query($query);

    }

    protected function disconnect($connection)
    {
        $connection = null;
    }

    protected function uploadImage($file, $targetDirectory = "")
    {
        $uniqueFilename = uniqid() . '_' . time();

        $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);

        $targetDirectoryPath = __DIR__ . "/../uploads" . $targetDirectory;
        if (!file_exists($targetDirectoryPath)) {
            mkdir($targetDirectoryPath, 0777, true);
        }

        $targetFile = $targetDirectoryPath . "/" . $uniqueFilename . "." . $fileExtension;

        $imageInfo = getimagesize($file["tmp_name"]);
        if ($imageInfo === false) {
            throw new ErrorException('Invalid image file.');
        }

        $allowedImageTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
        if (!in_array($imageInfo[2], $allowedImageTypes)) {
            throw new ErrorException('Unsupported image type. Only JPEG, PNG, and GIF are allowed.');
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return "/uploads" . $targetDirectory . "/" . $uniqueFilename . "." . $fileExtension;
        } else {
            throw new ErrorException('Error uploading file.');
        }
    }

}
?>