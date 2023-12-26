<?php

require_once __DIR__ . '/SharedAdminView.php';
require_once __DIR__ . '/../../controllers/VehicleReviewController.php';

class ReviewManagementView extends SharedAdminView
{

    public function displayReviewsPage()
    {

        $vehicleReviewController = new VehicleReviewController();

        $response = $vehicleReviewController->getReviews();

        $vehiclesReviews = $response["data"] ?? [];

        $totalPages = $response["totalPages"] ?? 0;

        $currentPage = $response["currentPage"] ?? 1;


        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="head">Reviews</h3>
                            </div>
                            <?php
                            $this->displayReviewsTable($vehiclesReviews);
                            ?>
                            <div class="d-flex justify-content-center">
                                <?php
                                $this->displayReviewsTablePagination($totalPages, $currentPage);
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
    }

    private function displayReviewsTable($vehiclesReviews)
    {
        ?>
        <div class="table-responsive">
            <table class="table  bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Vehicle / Brand</th>
                        <th scope="col">Review</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiclesReviews as $review) {
                        ?>
                        <tr>
                            <th>
                                <?= $review["username"] ?>
                            </th>
                            <th>
                                <?= $review["vehicleModel"] ?> -
                                <?= $review["vehicleVersion"] ?> -
                                <?= $review["vehicleYear"] ?>
                            </th>
                            <th scope="row">
                                <?= $review["review"] ?? "N/A"; ?>
                            </th>
                            <td>
                                <?= $this->showStars($review["rate"]) ?>
                            </td>
                            <td>
                                <div>

                                    <?php
                                    $statusColor = ($review['status'] === 'accepted') ? 'success' : (($review['status'] === 'pending') ? 'warning' : (($review['status'] == 'blocked') ? 'danger' : 'dark'));
                                    ?>
                                    <div class="badge badge-pill badge-<?= $statusColor ?> text-uppercase">
                                        <?= $review['status'] ?>
                                    </div>
                                    <p class="text-muted" style="font-size: 0.7rem">
                                        <?= date_format(date_create($review['createdAt']), "Y/m/d H:i:s"); ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    private function displayReviewsTablePagination($totalPages, $currentPage)
    {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?php echo $currentPage == 1 ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/admin/reviews?page=<?php echo $currentPage - 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?php echo $i == $currentPage ? "active" : ""; ?>">
                        <a class="page-link" href="/cars-comparer-2cs-project/admin/reviews?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?php echo $totalPages == $currentPage ? "disabled" : ""; ?>">
                    <a class="page-link"
                        href="/cars-comparer-2cs-project/admin/reviews?page=<?php echo $currentPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php
    }
}
?>