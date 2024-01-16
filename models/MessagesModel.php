<?php

require_once('Connection.php');

class MessagesModel extends Connection
{

    public function addMessage($email, $subject, $message)
    {

        if (empty($email)) {
            throw new ErrorException("Email is required");
        }
        if (empty($subject)) {
            throw new ErrorException("Subject is required");
        }
        if (empty($message)) {
            throw new ErrorException("Message is required");
        }

        $pdo = $this->connect();
        $sql = "INSERT INTO message (email, subject, message) VALUES (:email, :subject, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);
        return $stmt->rowCount();
    }

    public function getMessages()
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM message";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
?>