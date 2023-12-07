<?php

require_once('Connection.php');

class VehicleModel extends Connection
{
    public function addVehicle($brand_id, $model, $version, $year, $height, $width, $length, $consumption, $engine, $speed, $notes, $fuel_type, $pricing_range_from, $pricing_range_to, $Image, $acceleration)
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
        if (empty($notes)) {
            throw new ErrorException("Notes is required");
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
            $sql = "INSERT INTO vehicle (brand_id,model,version,year,height,width,length,consumption,engine,speed,notes,fuel_type,pricing_range_from,pricing_range_to,ImageURL,acceleration) VALUES (:brand_id,:model,:version,:year,:height,:width,:length,:consumption,:engine,:speed,:notes,:fuel_type,:pricing_range_from,:pricing_range_to,:ImageURL,:acceleration)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['brand_id' => $brand_id, 'model' => $model, 'version' => $version, 'year' => $year, 'height' => $height, 'width' => $width, 'length' => $length, 'consumption' => $consumption, 'engine' => $engine, 'speed' => $speed, 'notes' => $notes, 'fuel_type' => $fuel_type, 'pricing_range_from' => $pricing_range_from, 'pricing_range_to' => $pricing_range_to, 'ImageURL' => $ImageURL, 'acceleration' => $acceleration]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function getVehicles()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT vehicle.id, vehicle.model, vehicle.version, vehicle.year, vehicle.height, vehicle.width, vehicle.length, vehicle.consumption, vehicle.engine, vehicle.speed, vehicle.notes, vehicle.fuel_type, vehicle.pricing_range_from, vehicle.pricing_range_to, vehicle.ImageURL, vehicle.acceleration, brand.name as brand_name FROM vehicle INNER JOIN brand ON vehicle.brand_id = brand.id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            return $vehicles;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>