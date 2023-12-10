<?php

require_once(__DIR__ . "/../models/UserModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class UserController
{

    public function register()
    {
        $userModel = new UserModel();

        $name = $_POST['firstName'] ?? null;
        $lastName = $_POST['lastName'] ?? null;
        $email = $_POST['email'] ?? null;
        $gender = $_POST['gender'] ?? null;
        $birthDate = $_POST['birthDate'] ?? null;
        $password = $_POST['password'] ?? null;

        try {
            $userModel->signup($name, $lastName, $email, $gender, $birthDate, $password);

            return array(
                'status' => 200,
                'message' => 'User created successfully, Wait for the admin to approve your account'
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function login()
    {
        $userModel = new UserModel();

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        try {
            $user = $userModel->login($email, $password);

            SessionUtils::setSessionVariable('user', $user);

            return array(
                'status' => 200,
                'message' => 'Login successfully',
                'user' => $user
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function logout()
    {
        SessionUtils::destroySession();

        return array(
            'status' => 200,
            'message' => 'Logout successfully'
        );
    }

    public function getSessionUser()
    {
        $user = SessionUtils::getSessionVariable('user');

        if ($user) {
            return array(
                'status' => 200,
                'user' => $user
            );
        } else {
            return array(
                'status' => 400,
                'message' => 'User not found'
            );
        }
    }
}

?>