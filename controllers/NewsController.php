<?php

require_once(__DIR__ . "/../models/UserModel.php");
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();

class NewsController
{
    public function createNews()
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to create a news"
            );
        }

        $newsModel = new NewsModel();

        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $Image = $_FILES['Image'] ?? null;

        try {
            $newsModel->addNews($title, $description, $Image);

            return array(
                'status' => 200,
                'message' => "News created successfully"
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function getNews()
    {
        $newsModel = new NewsModel();

        $news = $newsModel->getNews();

        return array(
            'status' => 200,
            'news' => $news
        );
    }

    public function getNewsById($id)
    {
        $newsModel = new NewsModel();

        $news = $newsModel->getNewsById($id);

        return array(
            'status' => 200,
            'news' => $news
        );
    }

    public function updateNews($id)
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to update a news"
            );
        }

        $newsModel = new NewsModel();

        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $Image = $_FILES['Image'] ?? null;

        try {
            $newsModel->updateNews($id, $title, $description, $Image);

            return array(
                'status' => 200,
                'message' => "News updated successfully"
            );
        } catch (ErrorException $e) {
            return array(
                'status' => 400,
                'message' => $e->getMessage()
            );
        }
    }

    public function deleteNews($id)
    {
        if (SessionUtils::getSessionVariable('user')['role'] != 'admin') {
            return array(
                'status' => 400,
                'message' => "You must be an admin to delete a news"
            );
        }

        $newsModel = new NewsModel();

        try {
            $newsModel->deleteNews($id);

            return array(
                'status' => 200,
                'message' => "News deleted successfully"
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