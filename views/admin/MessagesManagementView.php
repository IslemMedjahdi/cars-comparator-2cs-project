<?php

require_once __DIR__ . '/SharedAdminView.php';

require_once __DIR__ . '/../../controllers/MessagesController.php';

class MessagesManagementView extends SharedAdminView
{

    public function displayMessagesPage()
    {

        $messagesController = new MessagesController();

        $messages = $messagesController->getMessages()['data'];

        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                $this->displaySideBar();
                ?>
                <main class="bg-light" style="width: calc(100% - 280px);height: 100vh; overflow-y: auto;">
                    <div class="container mt-5">
                        <h3 class="head">Messages</h3>
                        <div class="row w-100">
                            <div class="table-responsive">
                                <table data-toggle="table" data-pagination="true" data-search="true" class="bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" data-field="email" data-sortable="true">Email</th>
                                            <th scope="col" data-field="subject" data-sortable="true">Subject</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($messages as $message) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $message['email'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $message['subject'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $message['message'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php

    }
}

?>