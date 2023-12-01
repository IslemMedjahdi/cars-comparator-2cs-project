<?php
require_once __DIR__ . '/../views/AuthView.php';
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();


$base_path = '/cars-comparer-2cs-project';

$request = rtrim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

$request = substr($request, strlen($base_path));

$user = SessionUtils::getSessionVariable('user');

switch ($request) {
    case '/auth/register':
        if ($user) {
            header("Location: " . $base_path);
            exit();
        }
        $authViews = new AuthView();
        $authViews->displayRegisterPage();
        break;
    case '/auth/login':
        if ($user) {
            header("Location: " . $base_path);
            exit();
        }
        $authViews = new AuthView();
        $authViews->displayLoginPage();
        break;

    default:
        echo "404";
}
?>