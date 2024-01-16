<?php
require_once __DIR__ . '/SharedUserView.php';

require_once __DIR__ . '/../../utils/SessionUtils.php';

SessionUtils::startSession();

class ContactView extends SharedUserView
{
    public function displayContactPage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();

        $this->displayContacts();

        $this->displayContactUsForm();

        $this->displayFooter();
    }

    private function displayContacts()
    {
        $settingsController = new SettingsController();

        $contacts = $settingsController->getContact()["data"];

        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Contact Us</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div class="rounded-0 bg-light border p-4 d-flex gap-4">
                    <ul class="list-group list-group-flush w-100">
                        <li class="list-group-item">
                            Email :
                            <a href="mailto:<?= $contacts["email"] ?>" class="text-primary">
                                <?= $contacts["email"] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            Phone :
                            <a href="tel:<?= $contacts["phone_number"] ?>" class="text-primary">
                                <?= $contacts["phone_number"] ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            Address :
                            <span class="text-primary">
                                <?= $contacts["address"] ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayContactUsForm()
    {

        $user = SessionUtils::getSessionVariable('user');


        ?>
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="mt-4">
                <h2 class="head">Contact Us</h2>
            </div>
            <div class="w-100 mt-4" style="max-width: 1377px;">
                <div id="message"></div>
                <div class="rounded-0 bg-light border p-4 d-flex gap-4">
                    <div class="w-100">
                        <?php
                        if (!$user) {
                            ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input hidden type="email" name="email" value="<?= $user["email"] ?>" class="form-control" id="email"
                                required>
                            <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="messageBody" rows="3" required></textarea>
                        </div>
                        <button onclick="sendMessage()" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>