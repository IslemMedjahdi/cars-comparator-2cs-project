<?php


require_once(__DIR__ . "/../models/MessagesModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

class MessagesController
{
    public function sendMessage()
    {
        $email = $_POST['email'] ?? null;
        $subject = $_POST['subject'] ?? null;
        $message = $_POST['message'] ?? null;

        $messagesModel = new MessagesModel();

        try {
            $messagesModel->addMessage($email, $subject, $message);

            return array(
                'status' => 200,
                'message' => "Message sent successfully"
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getMessages()
    {

        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a news"
            );
        }

        $messagesModel = new MessagesModel();

        try {


            $messages = $messagesModel->getMessages();

            return array(
                'status' => 200,
                'data' => $messages
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }
}

?>