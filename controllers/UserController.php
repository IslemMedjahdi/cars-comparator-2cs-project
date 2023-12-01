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

            echo json_encode(
                array(
                    'status' => 200,
                    'message' => 'User created successfully, Wait for the admin to approve your account'
                )
            );
        } catch (ErrorException $e) {
            echo json_encode(
                array(
                    'status' => 400,
                    'message' => $e->getMessage()
                )
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

            echo json_encode(
                array(
                    'status' => 200,
                    'message' => 'Login successfully',
                    'user' => $user
                )
            );

        } catch (ErrorException $e) {
            echo json_encode(
                array(
                    'status' => 400,
                    'message' => $e->getMessage()
                )
            );
        }
    }

}

?>