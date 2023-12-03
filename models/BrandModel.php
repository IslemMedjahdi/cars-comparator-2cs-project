<?php

require_once 'Connection.php';


class BrandModel extends Connection
{
    public function addBrand($name, $CountryOfOrigin, $YearFounded, $WebsiteURL = null, $Description = null, $LogoImage)
    {
        if (empty($name) || empty($CountryOfOrigin) || empty($YearFounded)) {
            throw new ErrorException("All fields are required");
        }

        if (!is_numeric($YearFounded)) {
            throw new ErrorException("Year founded must be a number");
        }

        if (!empty($WebsiteURL) && !filter_var($WebsiteURL, FILTER_VALIDATE_URL)) {
            throw new ErrorException("Website URL is not valid");
        }

        if (isset($LogoImage) && $LogoImage['error'] === 0) {
            $LogoImageURL = $this->uploadImage($LogoImage, "/brands");
        } else {
            throw new ErrorException("Logo image is required");
        }


        $pdo = $this->connect();

        try {

            $sql = "INSERT INTO brand (name, CountryOfOrigin, YearFounded, WebsiteURL, Description, LogoImageURL) VALUES (:name, :CountryOfOrigin, :YearFounded, :WebsiteURL, :Description, :LogoImageURL)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name, 'CountryOfOrigin' => $CountryOfOrigin, 'YearFounded' => $YearFounded, 'WebsiteURL' => $WebsiteURL, 'Description' => $Description, 'LogoImageURL' => $LogoImageURL]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }


}

?>