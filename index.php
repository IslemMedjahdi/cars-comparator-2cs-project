<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carcompass</title>
    <link rel="stylesheet" href="/cars-comparer-2cs-project/css/main.css">
    <link rel="stylesheet" href="/cars-comparer-2cs-project/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/x-icon" href="/cars-comparer-2cs-project/assets/images/favicon.png">

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