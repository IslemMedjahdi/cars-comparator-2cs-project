<?php

require_once __DIR__ . '/SharedUserView.php';
require_once __DIR__ . '/../../controllers/NewsController.php';
class NewsView extends SharedUserView
{
    public function displayNewsHomePage()
    {
        $newsController = new NewsController();

        $news = $newsController->getNews()["data"] ?? [];


        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayNewsList($news);
        $this->displayFooter();
    }

    private function displayNewsList($news)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">News</h2>
            </div>
            <div class="w-100 mt-4 row" style="max-width: 1377px;">
                <?php foreach ($news as $newsItem) {
                    $this->displayNewsSummaryDetails($newsItem);
                } ?>
            </div>
        </div>
        <?php
    }

    private function displayNewsSummaryDetails($newsItem)
    {
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <a href="/cars-comparer-2cs-project/news?id=<?= $newsItem["id"]; ?>" style="overflow: hidden;">
                    <img style="height: 10rem;object-fit: cover;" class="card-img-top d-flex img-hover-transition"
                        src="/cars-comparer-2cs-project/<?= $newsItem["ImageURL"]; ?>" alt="<?= $newsItem["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $newsItem["title"]; ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8em;">
                        <?= $newsItem["createdAt"]; ?>
                    </h6>
                    <p class="card-text" style="font-size: 0.8em;">
                        <?= substr($newsItem["description"], 0, 100) . '...'; ?>
                        <a href="/cars-comparer-2cs-project/news?id=<?= $newsItem["id"]; ?>">Show
                            more</a>
                    </p>
                </div>


            </div>
        </div>
        <?php
    }

    public function displayNewsByIdPage()
    {

        $newsController = new NewsController();

        $news = $newsController->getNewsById()["data"] ?? null;

        if (!$news) {
            header("Location: /cars-comparer-2cs-project/news");
            exit();
        }

        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayNewsDetails($news);
        $this->displayFooter();


    }

    private function displayNewsDetails($news)
    {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">
                    <?= $news["title"] ?>
                </h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1024px;">
                <div class="card bg-light">
                    <img style="object-fit: contain;height: auto;" class="card-img-top d-flex"
                        src="/cars-comparer-2cs-project/<?= $news["ImageURL"]; ?>" alt="<?= $news["title"]; ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $news["title"]; ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8em;">
                            <?= $news["createdAt"]; ?>
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span>
                                <?= $news["description"]; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
}


?>