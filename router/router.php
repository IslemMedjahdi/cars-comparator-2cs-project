<?php
require_once __DIR__ . '/../views/AuthView.php';
require_once __DIR__ . '/../views/admin/AdminHomeView.php';
require_once __DIR__ . '/../views/admin/VehiclesManagementView.php';
require_once __DIR__ . '/../utils/SessionUtils.php';

SessionUtils::startSession();


$base_path = '/cars-comparer-2cs-project';

$request = rtrim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

$request = substr($request, strlen($base_path));

$user = SessionUtils::getSessionVariable('user');

function checkRoles($roles)
{
    global $user;
    if (!$user) {
        return false;
    }
    if (in_array($user['role'], $roles)) {
        return true;
    }
    return false;
}

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
    case '/admin':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $adminHomeView = new AdminHomePageView();
        $adminHomeView->displayHomePage();
        break;
    case '/admin/vehicles':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }

        $vehiclesManagementView = new VehiclesManagementView();
        $vehiclesManagementView->displayVehiclesPage();
        break;
    case '/admin/vehicles/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $authViews = new VehiclesManagementView();
        $authViews->displayCreateVehiclePage();
        break;
    default:
        echo "404";
}
?>