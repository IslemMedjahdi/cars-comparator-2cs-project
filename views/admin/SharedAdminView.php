<?php

class SharedAdminView
{

    private $sidebarItems = [
        [
            'name' => 'Home',
            'url' => '/cars-comparer-2cs-project/admin',
            'icon' => 'bi bi-house-door-fill',
        ],
        [
            'name' => 'Brands',
            'url' => '/cars-comparer-2cs-project/admin/brands',
            'icon' => 'bi bi-building'
        ],
        [
            'name' => 'Vehicles',
            'url' => '/cars-comparer-2cs-project/admin/vehicles',
            'icon' => 'bi bi-car-front',
        ],
    ];

    public function displaySideBar()
    {
        ?>
        <div class="position-relative d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
            style="width: 280px;height: 100vh">
            <div class="background-overlay"></div>
            <a href="/cars-comparer-2cs-project/admin" style="z-index: 100">
                <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="logo  w-100 white-filter" />
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto" style="z-index: 100">
                <?php
                foreach ($this->sidebarItems as $item) {
                    $isActive = rtrim(explode("?", $_SERVER['REQUEST_URI'])[0], "/") === $item['url'] || ($item['url'] !== "/cars-comparer-2cs-project/admin" && str_starts_with(rtrim(explode("?", $_SERVER['REQUEST_URI'])[0]), $item['url']));
                    ?>
                    <li class="mt-2">
                        <a href="<?= $item['url'] ?>" class="nav-link text-white <?= $isActive ? "bg-primary" : "bg-secondary" ?>">
                            <i class="<?= $item['icon'] ?>"></i>
                            <?= $item['name'] ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <button onclick="logout()" class="btn btn-danger text-start" style="z-index: 100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </div>
        <?php
    }

}

?>