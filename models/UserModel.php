<?php

require_once 'Connection.php';

class UserModel extends Connection
{

    private function checkExists($email)
    {
        $pdo = $this->connect();

        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function signup($firstName, $lastName, $email, $gender, $birthDate, $password)
    {
        if (empty($firstName) || empty($lastName) || empty($email) || empty($gender) || empty($birthDate) || empty($password)) {
            throw new ErrorException("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ErrorException("Invalid email format");
        }

        if ($this->checkExists($email)) {
            throw new ErrorException("Email already exists");
        }

        $pdo = $this->connect();

        try {

            $sql = "INSERT INTO user (firstName, lastName, email, sexe, birthDate, password) VALUES (:firstName, :lastName, :email, :sexe, :birthDate, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'sexe' => $gender, 'birthDate' => $birthDate, 'password' => $this->hashPassword($password)]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            throw new ErrorException("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ErrorException("Invalid email format");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                if (password_verify($password, $result['password'])) {
                    if ($result['isAccepted'] == 0) {
                        throw new ErrorException("Your account is not activated yet");
                    }
                    return $result;

                }
                throw new ErrorException("Invalid password");

            } else {
                throw new ErrorException("Invalid email");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>