<?php

require_once(__DIR__ . "/../models/UserModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class UserController
{

    public function register()
    {
        $userModel = new UserModel();

        $name = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birthDate'];
        $password = $_POST['password'];

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

        $email = $_POST['email'];
        $password = $_POST['password'];

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

}

?>