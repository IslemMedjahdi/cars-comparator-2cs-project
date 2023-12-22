<?php

require_once('Connection.php');

class VehicleModel extends Connection
{
    public function addVehicle($brand_id, $model, $version, $year, $height, $width, $length, $consumption, $engine, $speed, $description, $fuel_type, $pricing_range_from, $pricing_range_to, $Image, $acceleration)
    {
        if (empty($brand_id)) {
            throw new ErrorException("Brand is required");
        }
        if (empty($model)) {
            throw new ErrorException("Model is required");
        }
        if (empty($version)) {
            throw new ErrorException("Version is required");
        }
        if (empty($year)) {
            throw new ErrorException("Year is required");
        }
        if (empty($height)) {
            throw new ErrorException("Height is required");
        }
        if (empty($width)) {
            throw new ErrorException("Width is required");
        }
        if (empty($length)) {
            throw new ErrorException("Length is required");
        }
        if (empty($consumption)) {
            throw new ErrorException("Consumption is required");
        }
        if (empty($engine)) {
            throw new ErrorException("Engine is required");
        }
        if (empty($speed)) {
            throw new ErrorException("Speed is required");
        }
        if (empty($description)) {
            throw new ErrorException("Description is required");
        }
        if (empty($fuel_type)) {
            throw new ErrorException("Fuel type is required");
        }
        if (empty($pricing_range_from)) {
            throw new ErrorException("Pricing range from is required");
        }
        if (empty($pricing_range_to)) {
            throw new ErrorException("Pricing range to is required");
        }
        if (empty($acceleration)) {
            throw new ErrorException("Acceleration is required");
        }
        if (isset($Image) && $Image['error'] === 0) {
            $ImageURL = $this->uploadImage($Image, "/vehicles");
        } else {
            throw new ErrorException("Logo image is required");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO vehicle (brand_id,model,version,year,height,width,length,consumption,engine,speed,description,fuel_type,pricing_range_from,pricing_range_to,ImageURL,acceleration) VALUES (:brand_id,:model,:version,:year,:height,:width,:length,:consumption,:engine,:speed,:description,:fuel_type,:pricing_range_from,:pricing_range_to,:ImageURL,:acceleration)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['brand_id' => $brand_id, 'model' => $model, 'version' => $version, 'year' => $year, 'height' => $height, 'width' => $width, 'length' => $length, 'consumption' => $consumption, 'engine' => $engine, 'speed' => $speed, 'description' => $description, 'fuel_type' => $fuel_type, 'pricing_range_from' => $pricing_range_from, 'pricing_range_to' => $pricing_range_to, 'ImageURL' => $ImageURL, 'acceleration' => $acceleration]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function getVehicles($page = 1, $perPage = 10)
    {
        $pdo = $this->connect();

        try {

            $offset = ($page - 1) * $perPage;

            $sql = "SELECT vehicle.id, vehicle.model, vehicle.version, vehicle.year, vehicle.height, vehicle.width, vehicle.length, vehicle.consumption, vehicle.engine, vehicle.speed, vehicle.description, vehicle.fuel_type, vehicle.pricing_range_from, vehicle.pricing_range_to, vehicle.ImageURL, vehicle.acceleration, brand.name as brand_name FROM vehicle INNER JOIN brand ON vehicle.brand_id = brand.id LIMIT $perPage OFFSET $offset";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $vehicles;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getVehiclesCount()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM vehicle";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $count;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteVehicle($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "DELETE FROM vehicle WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getVehiclesByBrandId($brandId)
    {
        $pdo = $this->connect();

        try {
            // inner join with brand table
            $sql = "SELECT vehicle.id, vehicle.model, vehicle.version, vehicle.year, vehicle.height, vehicle.width, vehicle.length, vehicle.consumption, vehicle.engine, vehicle.speed, vehicle.description, vehicle.fuel_type, vehicle.pricing_range_from, vehicle.pricing_range_to, vehicle.ImageURL, vehicle.acceleration, brand.name as brand_name FROM vehicle INNER JOIN brand ON vehicle.brand_id = brand.id WHERE brand_id = :brandId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['brandId' => $brandId]);
            $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $vehicles;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getVehicleById($id)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT vehicle.id, vehicle.model, vehicle.version, vehicle.year, vehicle.height, vehicle.width, vehicle.length, vehicle.consumption, vehicle.engine, vehicle.speed, vehicle.description, vehicle.fuel_type, vehicle.pricing_range_from, vehicle.pricing_range_to, vehicle.ImageURL, vehicle.acceleration, brand.name as brand_name FROM vehicle INNER JOIN brand ON vehicle.brand_id = brand.id WHERE vehicle.id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$vehicle) {
                throw new ErrorException("Vehicle not found");
            }

            $sql = "SELECT AVG(rate) FROM vehicle_review WHERE vehicleId = :vehicleId AND status='accepted'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['vehicleId' => $id]);
            $vehicle['average_rate'] = $stmt->fetchColumn() ?? 5;

            $this->disconnect($pdo);

            return $vehicle;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>