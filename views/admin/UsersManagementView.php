<?php
require_once __DIR__ . '/SharedAdminView.php';

require_once __DIR__ . '/../../controllers/UserController.php';


class UsersManagementView extends SharedAdminView
{
    public function displayUsersPage()
    {

        $usersController = new UserController();

        $response = $usersController->getUsers();

        $users = $response["data"];

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
                                <h3 class="head">Users</h3>
                            </div>
                            <div id="message">
                            </div>
                            <?php
                            $this->displayUsersTable($users);
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
    }


    private function displayUsersTable($users)
    {
        ?>
        <div class="table-responsive">
            <table data-toggle="table" data-pagination="true" data-search="true">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                        <th scope="col" data-field="username" data-sortable="true">Username</th>
                        <th scope="col" data-field="firstname" data-sortable="true">First Name</th>
                        <th scope="col" data-field="lastname" data-sortable="true">Last Name</th>
                        <th scope="col" data-field="email" data-sortable="true">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $user['id'] ?>
                            </th>
                            <td>
                                <?= $user['username'] ?>
                            </td>
                            <td>
                                <?= $user['firstName'] ?>
                            </td>
                            <td>
                                <?= $user['lastName'] ?>
                            </td>
                            <td>
                                <a href="mailto:<?= $user['email'] ?>">
                                    <?= $user['email'] ?>
                                </a>
                            </td>

                            <td>
                                <div>

                                    <?php
                                    $statusColor = ($user['status'] === 'accepted') ? 'success' : (($user['status'] === 'pending') ? 'warning' : (($user['status'] == 'blocked') ? 'danger' : 'dark'));
                                    ?>
                                    <div class="badge badge-pill badge-<?= $statusColor ?> text-uppercase">
                                        <?= $user['status'] ?>
                                    </div>
                                    <p class="text-muted" style="font-size: 0.7rem">
                                        <?= date_format(date_create($user['statusDate']), "Y/m/d H:i:s"); ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton<?= $user['id'] ?>"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $user['id'] ?>">
                                        <?php
                                        if ($user['status'] === 'pending') {
                                            ?>
                                            <div class="dropdown-item btn" onclick="acceptUser(<?= $user["id"] ?>)">Accept</div>
                                            <div class="dropdown-item btn" onclick="rejectUser(<?= $user["id"] ?>)">Reject</div>
                                            <?php
                                        } else if ($user['status'] === 'accepted') {
                                            ?>
                                                <div class="dropdown-item btn" onclick="blockUser(<?= $user["id"] ?>)">Block</div>
                                            <?php
                                        } else if ($user['status'] === 'blocked') {
                                            ?>
                                                    <div class="dropdown-item btn" onclick="activateUser(<?= $user["id"] ?>)">Activate</div>
                                            <?php
                                        } else if ($user['status'] === 'rejected') {
                                            ?>
                                                        <div class="dropdown-item btn" onclick="activateUser(<?= $user["id"] ?>)">Activate</div>
                                            <?php
                                        }
                                        ?>
                                    </div>
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


}
?>