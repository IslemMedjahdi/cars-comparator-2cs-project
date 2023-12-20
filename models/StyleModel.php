<?php

require_once('Connection.php');


class StyleModel extends Connection
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

            $sql = "UPDATE style SET logoUrl = :logoUrl, faviconUrl = :faviconUrl, primary_color = :primaryColor, facebook_url = :facebook, linkedin_url = :linkedin, instagram_url = :instagram WHERE id = 1";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'logoUrl' => $logoUrl,
                'faviconUrl' => $faviconUrl,
                'primaryColor' => $primaryColor,
                'facebook' => $facebook,
                'linkedin' => $linkedin,
                'instagram' => $instagram
            ]);
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
        $sql = "SELECT primary_color as PrimaryColor FROM style";
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

}
?>