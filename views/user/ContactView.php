<?php
require_once __DIR__ . '/SharedUserView.php';

class ContactView extends SharedUserView
{
    public function displayContactPage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();

        $this->displayContacts();

        $this->displayFooter();
    }

    private function displayContacts()
    {

    }
}
?>