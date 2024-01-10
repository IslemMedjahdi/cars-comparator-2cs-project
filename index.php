<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    require_once(__DIR__ . "/controllers/SettingsController.php");
    $settingsController = new SettingsController();
    $faviconUrl = $settingsController->getFavicon()['data']["faviconUrl"] ?? "/assets/images/favicon.png";
    $primaryColor = $settingsController->getPrimaryColor()['data']["primary_color"] ?? "#0d6efd";
    $title = $settingsController->getContent()['data']["title"] ?? "Carcompass";
    ?>
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="/cars-comparer-2cs-project/css/main.css">
    <link rel="stylesheet" href="/cars-comparer-2cs-project/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/x-icon" href="/cars-comparer-2cs-project<?= $faviconUrl ?>">



    <style>
        :root {
            --primary:
                <?= $primaryColor ?>
            ;
        }

        .btn-primary,
        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            box-shadow: unset !important;
        }

        .btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary:focus {
            color: var(--primary) !important;
            border-color: var(--primary) !important;
            box-shadow: unset !important;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary) !important;
            color: white !important;
        }


        .text-primary,
        .text-primary:hover,
        .text-primary:active,
        .text-primary:focus {
            color: var(--primary) !important;
        }

        .bg-primary,
        .bg-primary:hover,
        .bg-primary:active,
        .bg-primary:focus {
            background-color: var(--primary) !important;
        }

        a.bg-primary:hover,
        a.bg-primary:active,
        a.bg-primary:focus {
            background-color: var(--primary) !important;
        }

        .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: unset !important;
        }

        .badge-primary {
            background-color: var(--primary) !important;
        }

        .dropdown-item:active,
        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: var(--primary) !important;
        }
    </style>

</head>

<body>
    <div id="loader" class="position-absolute align-items-center justify-content-center w-100"
        style="height: 100vh;background-color: #343a404f;display: none;z-index: 9999;">
        <div class="loader text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php require_once("./router/router.php") ?>

    <script src="/cars-comparer-2cs-project/js/main.js"></script>
    <script src="/cars-comparer-2cs-project/js/popper.min.js"></script>
    <script src="/cars-comparer-2cs-project/js/jquery-3.7.1.min.js"></script>
    <script src="/cars-comparer-2cs-project/js/bootstrap.min.js"></script>

</body>

</html>