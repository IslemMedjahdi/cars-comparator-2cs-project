<?php

require_once('Connection.php');


class SettingsModel extends Connection
{

    public function updateStyles($logo = null, $favicon = null, $primaryColor = null, $facebook = null, $linkedin = null, $instagram = null)
    {
        $logoUrl = null;
        if (isset($logo) && $logo['error'] === 0) {
            $logoUrl = $this->uploadImage($logo, "/style");
        }

        $faviconUrl = null;
        if (isset($favicon) && $favicon['error'] === 0) {
            $faviconUrl = $this->uploadImage($favicon, "/style");
        }

        try {

            $pdo = $this->connect();

            $sql = "UPDATE style SET ";
            $params = [];

            if ($logoUrl !== null) {
                $sql .= "logoUrl = :logoUrl, ";
                $params['logoUrl'] = $logoUrl;
            }

            if ($faviconUrl !== null) {
                $sql .= "faviconUrl = :faviconUrl, ";
                $params['faviconUrl'] = $faviconUrl;
            }

            if ($primaryColor !== null) {
                $sql .= "primary_color = :primaryColor, ";
                $params['primaryColor'] = $primaryColor;
            }

            if ($facebook !== null) {
                $sql .= "facebook_url = :facebook, ";
                $params['facebook'] = $facebook;
            }

            if ($linkedin !== null) {
                $sql .= "linkedin_url = :linkedin, ";
                $params['linkedin'] = $linkedin;
            }

            if ($instagram !== null) {
                $sql .= "instagram_url = :instagram, ";
                $params['instagram'] = $instagram;
            }

            $sql = rtrim($sql, ", ");
            $sql .= " WHERE id = 1";

            $stmt = $pdo->prepare($sql);

            $stmt->execute($params);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getLogo()
    {
        $sql = "SELECT logoUrl FROM style";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getFavicon()
    {
        $sql = "SELECT faviconUrl FROM style";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getPrimaryColor()
    {
        $sql = "SELECT primary_color  FROM style";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getSocialMedia()
    {
        $sql = "SELECT facebook_url,linkedin_url,instagram_url FROM style";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    public function updateContent($email = null, $phone = null, $address = null, $title = null, $description = null)
    {
        try {

            $pdo = $this->connect();

            $sql = "UPDATE content SET ";
            $params = [];

            if ($email !== null) {
                $sql .= "email = :email, ";
                $params['email'] = $email;
            }

            if ($phone !== null) {
                $sql .= "phone_number = :phone, ";
                $params['phone'] = $phone;
            }

            if ($address !== null) {
                $sql .= "address = :address, ";
                $params['address'] = $address;
            }

            if ($title !== null) {
                $sql .= "title = :title, ";
                $params['title'] = $title;
            }

            if ($description !== null) {
                $sql .= "description = :description, ";
                $params['description'] = $description;
            }

            $sql = rtrim($sql, ", ");
            $sql .= " WHERE id = 1";

            $stmt = $pdo->prepare($sql);

            $stmt->execute($params);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getContact()
    {
        $sql = "SELECT email,phone_number,address FROM content WHERE id = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getContent()
    {
        $sql = "SELECT title,description FROM content WHERE id = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

}
?>