<?php

require_once __DIR__ . '/SharedAdminView.php';
require_once __DIR__ . '/../../controllers/NewsController.php';


class NewsManagementView extends SharedAdminView
{

    public function displayCreateNewsPage()
    {
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="d-flex justify-content-center w-100">
                        <div class="container mt-5">
                            <h3 class="head">Create News:</h3>
                            <div id="message"></div>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Image">Image:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Image" name="Image"
                                                    accept="image/*" required>
                                                <label class="custom-file-label" for="Image">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="/cars-comparer-2cs-project/admin/news" class="btn btn-secondary">Back</a>
                                    <button onclick="createNews()" class="btn btn-primary"><i
                                            class="bi bi-plus-circle-fill"></i>
                                        Submit</button>
                                </div>
                            </div>
                </main>
            </div>
        </div>
        <?php
    }

    public function displayNewsPage()
    {
        $newsController = new NewsController();

        $response = $newsController->getNews();

        $news = $response["data"];


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
                                <h3 class="head">News</h3>
                                <a href="/cars-comparer-2cs-project/admin/news/create" class="btn btn-primary"><i
                                        class="bi bi-plus-circle-fill"></i> Create
                                    News</a>
                            </div>
                            <?php
                            $this->displayNewsTable($news);
                            ?>

                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
    }

    private function displayNewsTable($news)
    {
        ?>

        <div class="table-responsive">
            <table data-toggle="table" data-pagination="true" data-search="true" class="bg-white">
                <thead class="thead-dark">
                    <tr>

                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                        <th scope="col" data-field="title" data-sortable="true">Title</th>
                        <th scope="col" data-field="createdAt" data-sortable="true">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($news as $newsItem) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $newsItem["id"]; ?>
                            </th>
                            <td>
                                <?php echo $newsItem["title"]; ?>
                            </td>
                            <td>
                                <?= date_format(date_create($newsItem['createdAt']), "Y/m/d H:i:s"); ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/cars-comparer-2cs-project/admin/news/edit?id=<?php echo $newsItem["id"]; ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button onclick="deleteNewsById(<?php echo $newsItem["id"]; ?>)" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
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