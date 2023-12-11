<?php

require_once 'Connection.php';

class UserModel extends Connection
{

    private function checkExists($username)
    {
        $pdo = $this->connect();

        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

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

    public function signup($username, $firstName, $lastName, $email, $gender, $birthDate, $password)
    {
        if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($gender) || empty($birthDate) || empty($password)) {
            throw new ErrorException("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ErrorException("Invalid email format");
        }

        if ($this->checkExists($username)) {
            throw new ErrorException("Username already exists");
        }

        $pdo = $this->connect();

        try {

            $sql = "INSERT INTO user (username,firstName, lastName, email, sexe, birthDate, password) VALUES (:username,:firstName, :lastName, :email, :sexe, :birthDate, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'sexe' => $gender, 'birthDate' => $birthDate, 'password' => $this->hashPassword($password)]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            throw new ErrorException("All fields are required");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                if (password_verify($password, $result['password'])) {
                    $status = $result['status'];
                    if ($status === 'pending') {
                        throw new ErrorException("Your account is not activated yet");
                    }
                    if ($status === 'rejected') {
                        throw new ErrorException("Your account is rejected");
                    }
                    if ($status === 'blocked') {
                        throw new ErrorException("Your account is blocked");
                    }
                    return $result;

                }
                throw new ErrorException("Invalid password");

            } else {
                throw new ErrorException("Invalid username");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUsers($page, $perPage)
    {

        $pdo = $this->connect();

        try {
            // dont get admin
            $sql = "SELECT * FROM user WHERE role != 'admin' LIMIT :page, :perPage";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':page', (int) ($page - 1) * $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', (int) $perPage, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUsersCount()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUserById($id)
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function acceptUser($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = :id AND status = 'pending'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE user SET status = 'accepted' ,statusDate = NOW() WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $id]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already accepted");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function rejectUser($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = :id AND status = 'pending'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE user SET status = 'rejected',statusDate = NOW() WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $id]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already rejected");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function blockUser($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = :id AND status = 'accepted'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE user SET status = 'blocked',statusDate = NOW() WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $id]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already blocked");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function activateUser($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = :id AND status = 'blocked' OR status = 'rejected'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE user SET status = 'accepted', statusDate = NOW() WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $id]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already activated");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>