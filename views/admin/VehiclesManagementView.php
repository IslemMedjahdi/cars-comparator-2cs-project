<?php
require_once __DIR__ . '/SharedAdminView.php';
class VehiclesManagementView extends SharedAdminView
{
    public function displayCreateVehiclePage()
    {
        $this->displaySideBar(<<<HTML
        <h2>Create a new car</h2>
        HTML);
    }

    public function displayVehiclesPage()
    {
        $this->displaySideBar(
            <<<HTML
            <h2>Vehicles</h2>
            HTML
        );

    }

}
?>