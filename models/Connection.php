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
        $targetFile = __DIR__ . "/../uploads" . $targetDirectory . "/" . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return "/uploads" . $targetDirectory . "/" . basename($file["name"]);
        } else {
            throw new ErrorException('Error uploading file.');
        }
    }
}
?>