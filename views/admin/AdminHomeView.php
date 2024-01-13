<?php
require_once __DIR__ . '/SharedAdminView.php';
class AdminHomePageView extends SharedAdminView
{
    private $cards = [
        [
            'name' => 'Landing Page',
            'url' => '/cars-comparer-2cs-project',
            'icon' => 'bi bi-house-fill',
        ],
        [
            'name' => 'Users',
            'url' => '/cars-comparer-2cs-project/admin/users',
            'icon' => 'bi bi-people-fill',
        ],
        [
            'name' => 'Brands',
            'url' => '/cars-comparer-2cs-project/admin/brands',
            'icon' => 'bi bi-building'
        ],
        [
            'name' => 'News',
            'url' => '/cars-comparer-2cs-project/admin/news',
            'icon' => 'bi bi-newspaper',
        ],
        [
            'name' => 'Reviews',
            'url' => '/cars-comparer-2cs-project/admin/reviews',
            'icon' => 'bi bi-chat-left-text-fill',
        ],
        [
            'name' => 'Settings',
            'url' => '/cars-comparer-2cs-project/admin/settings',
            'icon' => 'bi bi-gear-fill',
        ],


    ];

    public function displayHomePage()
    {

        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="container mt-5">
                        <h3 class="head">Home</h3>
                        <div class="row w-100">
                            <?php
                            foreach ($this->cards as $card) {
                                $this->diplayCard($card['name'], $card['url'], $card['icon']);
                            }
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php

    }

    public function diplayCard($title, $href, $icon)
    {
        ?>
        <div class="col-md-3 col-sm-6 p-2">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid #4e73df!important;">
                <a href="<?= $href; ?>" style="text-decoration: none;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2" style="text-align: center;">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?= $title; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="<?php echo $icon; ?>"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php
    }
}
?>