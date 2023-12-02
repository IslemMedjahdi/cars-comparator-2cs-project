<?php

class SharedAdminView
{

    private $sidebarItems = [
        [
            'name' => 'Home',
            'url' => '/cars-comparer-2cs-project/admin',
            'icon' => 'fa-house',
        ],
        [
            'name' => 'Vehicles',
            'url' => '/cars-comparer-2cs-project/admin/vehicles',
            'icon' => 'fa-car',
        ],
    ];

    public function displaySideBar($mainContent = null)
    {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class=" position-relative d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
                    style="width: 280px;height: 100vh">
                    <div class="background-overlay"></div>
                    <a href="/cars-comparer-2cs-project/admin" style="z-index: 100">
                        <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="logo  w-100" />
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto" style="z-index: 100">
                        <?php
                        foreach ($this->sidebarItems as $item) {
                            ?>
                            <li class="mt-2">
                                <a href="<?= $item['url'] ?>"
                                    class="nav-link text-white <?= $item['url'] === rtrim(explode("?", $_SERVER['REQUEST_URI'])[0], "/") ? "bg-primary" : "bg-secondary" ?>">
                                    <i class="fas <?= $item['icon'] ?>"></i>
                                    <?= $item['name'] ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <main>
                    <?php

                    if ($mainContent) {
                        echo $mainContent;
                    }
                    ?>
                </main>
            </div>
        </div>
        <?php
    }

}

?>