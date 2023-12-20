<?php

require_once('Connection.php');

class ComparisionHistoryModel extends Connection
{
    public function addComparision($userId, $vehicleId1, $vehicleId2)
    {
        if (empty($userId)) {
            throw new ErrorException("User id is required");
        }

        if (empty($vehicleId1)) {
            throw new ErrorException("Vehicle id 1 is required");
        }

        if (empty($vehicleId2)) {
            throw new ErrorException("Vehicle id 2 is required");
        }

        $pdo = $this->connect();
        try {

            $sql = "INSERT INTO comparison_history (userId, vehicle1Id, vehicle2Id) VALUES (:userId, :vehicle1Id, :vehicle2Id)";

            $stmt = $pdo->prepare($sql);

            // to make sure that the vehicle with the lowest id is always in the vehicle1Id column
            if ($vehicleId1 > $vehicleId2) {
                $temp = $vehicleId1;
                $vehicleId1 = $vehicleId2;
                $vehicleId2 = $temp;
            }

            $stmt->execute([
                'userId' => $userId,
                'vehicle1Id' => $vehicleId1,
                'vehicle2Id' => $vehicleId2
            ]);

            $this->disconnect($pdo);

        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }

    }

    public function getMostComparedVehicles()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT 
            vh1.id as id1, 
            vh1.brand_id as brand_id1, 
            vh1.model as model1, 
            vh1.version as version1, 
            vh1.year as year1, 
            vh1.height as height1, 
            vh1.width as width1, 
            vh1.length as length1, 
            vh1.consumption as consumption1, 
            vh1.engine as engine1, 
            vh1.speed as speed1, 
            vh1.description as description1, 
            vh1.fuel_type as fuel_type1, 
            vh1.pricing_range_from as pricing_range_from1, 
            vh1.pricing_range_to as pricing_range_to1, 
            vh1.acceleration as acceleration1, 
            vh1.ImageURL as ImageURL1,
            
            vh2.id as id2, 
            vh2.brand_id as brand_id2, 
            vh2.model as model2, 
            vh2.version as version2, 
            vh2.year as year2, 
            vh2.height as height2, 
            vh2.width as width2, 
            vh2.length as length2, 
            vh2.consumption as consumption2, 
            vh2.engine as engine2, 
            vh2.speed as speed2, 
            vh2.description as description2, 
            vh2.fuel_type as fuel_type2, 
            vh2.pricing_range_from as pricing_range_from2, 
            vh2.pricing_range_to as pricing_range_to2, 
            vh2.acceleration as acceleration2, 
            vh2.ImageURL as ImageURL2,
            
            COUNT(*) AS count 
        FROM 
            comparison_history ch
            INNER JOIN vehicle vh1 ON ch.vehicle1Id = vh1.id
            INNER JOIN vehicle vh2 ON ch.vehicle2Id = vh2.id
        GROUP BY 
            vh1.id, vh2.id
        ORDER BY 
            count DESC
        LIMIT 4;
        ";

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $sql_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->disconnect($pdo);

            $result = [];

            foreach ($sql_result as $key => $value) {
                $result[$key] = [
                    'vehicle_1' => [
                        'id' => $value['id1'],
                        'brand_id' => $value['brand_id1'],
                        'model' => $value['model1'],
                        'version' => $value['version1'],
                        'year' => $value['year1'],
                        'height' => $value['height1'],
                        'width' => $value['width1'],
                        'length' => $value['length1'],
                        'consumption' => $value['consumption1'],
                        'engine' => $value['engine1'],
                        'speed' => $value['speed1'],
                        'description' => $value['description1'],
                        'fuel_type' => $value['fuel_type1'],
                        'pricing_range_from' => $value['pricing_range_from1'],
                        'pricing_range_to' => $value['pricing_range_to1'],
                        'acceleration' => $value['acceleration1'],
                        'ImageURL' => $value['ImageURL1'],

                    ],
                    'vehicle_2' => [
                        'id' => $value['id2'],
                        'brand_id' => $value['brand_id2'],
                        'model' => $value['model2'],
                        'version' => $value['version2'],
                        'year' => $value['year2'],
                        'height' => $value['height2'],
                        'width' => $value['width2'],
                        'length' => $value['length2'],
                        'consumption' => $value['consumption2'],
                        'engine' => $value['engine2'],
                        'speed' => $value['speed2'],
                        'description' => $value['description2'],
                        'fuel_type' => $value['fuel_type2'],
                        'pricing_range_from' => $value['pricing_range_from2'],
                        'pricing_range_to' => $value['pricing_range_to2'],
                        'acceleration' => $value['acceleration2'],
                        'ImageURL' => $value['ImageURL2'],

                    ],
                    'count' => $value['count']
                ];
            }



            return $result;

        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}

?>