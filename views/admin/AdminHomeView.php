<?php
require_once __DIR__ . '/SharedAdminView.php';
class AdminHomePageView extends SharedAdminView
{
    public function displayHomePage()
    {
        $this->displaySideBar(
            <<<HTML
        <h2>Home</h2>
        HTML
        );

    }
}
?>