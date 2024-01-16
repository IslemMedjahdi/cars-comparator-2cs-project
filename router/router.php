<?php
require_once __DIR__ . '/../views/AuthView.php';

require_once __DIR__ . '/../views/admin/AdminHomeView.php';
require_once __DIR__ . '/../views/admin/VehiclesManagementView.php';
require_once __DIR__ . '/../views/admin/BrandsManagementView.php';
require_once __DIR__ . '/../views/admin/UsersManagementView.php';
require_once __DIR__ . '/../views/admin/SettingsManagementView.php';
require_once __DIR__ . '/../views/user/HomeView.php';
require_once __DIR__ . '/../views/user/SharedUserView.php';
require_once __DIR__ . '/../views/user/BrandsView.php';
require_once __DIR__ . '/../views/user/MyProfileView.php';
require_once __DIR__ . '/../views/user/CompareView.php';
require_once __DIR__ . '/../views/user/VehiclesView.php';
require_once __DIR__ . '/../views/admin/NewsManagementView.php';
require_once __DIR__ . '/../views/user/NewsView.php';
require_once __DIR__ . '/../views/admin/ReviewsManagementView.php';
require_once __DIR__ . '/../views/user/ReviewsView.php';
require_once __DIR__ . '/../views/user/ContactView.php';
require_once __DIR__ . '/../views/user/BuyingGuideView.php';
require_once __DIR__ . '/../views/user/CompanyView.php';
require_once __DIR__ . '/../views/admin/MessagesManagementView.php';

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
        $vehiclesManagementView = new VehiclesManagementView();
        $vehiclesManagementView->displayCreateVehiclePage();
        break;
    case '/admin/vehicles/edit':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        if (!isset($_GET['id'])) {
            header("Location: " . $base_path);
            exit();
        }
        $vehiclesManagementView = new VehiclesManagementView();
        $vehiclesManagementView->displayEditVehiclePage();
        break;
    case '/admin/brands':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $brandsManagementView = new BrandsManagementView();
        $brandsManagementView->displayBrandsPage();
        break;
    case '/admin/brands/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $brandsManagementView = new BrandsManagementView();
        $brandsManagementView->displayCreateBrandPage();
        break;
    case '/admin/brands/edit':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . $base_path);
            exit();
        }
        $brandsManagementView = new BrandsManagementView();
        $brandsManagementView->displayEditBrandPage();
        break;
    case '/admin/users':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $usersManagementView = new UsersManagementView();
        $usersManagementView->displayUsersPage();
        break;
    case '/admin/news':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $newsManagementView = new NewsManagementView();
        $newsManagementView->displayNewsPage();
        break;
    case '/admin/news/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $newsManagementView = new NewsManagementView();
        $newsManagementView->displayCreateNewsPage();
        break;
    case '/admin/news/edit':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
        }
        if (!isset($_GET['id'])) {
            header("Location: " . $base_path);
            exit();
        }
        $newsManagementView = new NewsManagementView();
        $newsManagementView->displayEditNewsPage();
        break;
    case '/admin/reviews':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $reviewsManagementView = new ReviewManagementView();
        $reviewsManagementView->displayReviewsPage();
        break;
    case '/admin/settings':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $settingsManagementView = new SettingsManagementView();
        $settingsManagementView->displaySettingsPage();
        break;
    case '/admin/messages':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        $messagesManagementView = new MessagesManagementView();
        $messagesManagementView->displayMessagesPage();
        break;
    case '':
        $homeView = new HomeView();
        $homeView->displayHomePage();
        break;
    case '/brands':
        $brandsView = new BrandsView();
        if (!isset($_GET['id'])) {
            $brandsView->displayBrandsPage();
            break;
        }
        $brandsView->displayBrandByIdPage();
        break;
    case '/auth/profile':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }

        if (isset($_GET["id"])) {
            if (!checkRoles(['admin'])) {
                header("Location: " . $base_path);
                exit();
            }
        }

        $myProfileView = new MyProfileView();
        $myProfileView->displayProfilePage();
        break;
    case '/compare':
        $compareView = new CompareView();
        if (!isset($_GET['id'])) {
            $compareView->displayCompareHomePage();
            break;
        }
        $compareView->displayComparePage();
        break;
    case '/vehicles':
        $vehiclesView = new VehiclesView();
        if (!isset($_GET['id'])) {
            $vehiclesView->displayVehiclesPage();
            break;
        }
        $vehiclesView->displayVehicleByIdPage();
        break;
    case '/news':
        $newsView = new NewsView();
        if (!isset($_GET['id'])) {
            $newsView->displayNewsHomePage();
            break;
        }
        $newsView->displayNewsByIdPage();
        break;
    case '/reviews':
        $reviewsView = new ReviewsView();
        if (!isset($_GET['id'])) {
            $reviewsView->displayReviewsHomePage();
            break;
        }
        $reviewsView->displayVehicleReviewsByIdPage();
        break;
    case '/contact':
        $sharedView = new ContactView();
        $sharedView->displayContactPage();
        break;
    case '/buying-guide':
        $buyingGuideView = new BuyingGuideView();
        $buyingGuideView->displayBuyingGuidePage();
        break;
    case '/company':
        $companyView = new CompanyView();
        $companyView->displayCompanyPage();
        break;
    default:
        $sharedView = new SharedUserView();
        $sharedView->displayNotFoundPage();
        break;

}
?>