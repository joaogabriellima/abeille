<?php

namespace Abeille;

if (file_exists('../../api/config/database.php'))
    include_once '../../api/config/database.php';
else 
    include_once 'api/config/database.php';

class Attendance {

    private $conn;
    private $table_name = 'attendance';

    private $dayHours = [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];

    public $id;
    public $queue_number;
    public $id_user;
    public $status;
    public $rate;
    public $start_time;
    public $end_time;
    public $total_time;
    public $created_at;

    public function __construct($db=null) {
        $this->conn = $db == null
                        ? new Database()
                        : $db;
    }

    public function create() {
        $query =    'INSERT INTO ' . $this->table_name .
                    ' SET queue_number=:queue_number, status=:status';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':queue_number', $this->queue_number);
        $stmt->bindParam(':status', $this->status);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }

    public function getLastQueueNumber() {
        $query =   'SELECT queue_number, created_at
                    FROM ' . $this->table_name . ' 
                    WHERE DATE(created_at) = DATE(NOW())
                    ORDER BY created_at DESC
                    LIMIT 1';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            extract($row);

            return array(
                'queue_number'=>$queue_number,
                'created_at'=>$created_at
            );
        } else {
           return null;
        }
    }

    public function getStatus() {
        $query =    'SELECT status
                    FROM ' . $this->table_name . ' 
                    WHERE Id = :id';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) { 
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            extract($row);

            $this->status = $status;

            return $this->status;
        } else {
            return null;
        }
    }

    public function getCurrentAttendance($newObject) {
        $query =    'SELECT queue_number
                    FROM ' . $this->table_name . ' 
                    WHERE DATE(created_at) = DATE(NOW())
                        AND start_time IS NOT NULL
                    ORDER BY queue_number DESC
                    LIMIT 1';

        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            \extract($row);
        } else {
            $queue_number = 0;
        }

        if ($newObject == true) {
            $res = new Attendance();
            $res->queue_number = intval($queue_number);

            return $res;
        } else {
            $this->queue_number = intval($queue_number);

            return $this->queue_number;
        }
    }

    public function getAverageTime() {
        $query =    'SELECT total_time
                    FROM ' . $this->table_name . ' 
                    WHERE DATE(created_at) = DATE(NOW())
                        AND total_time IS NOT NULL';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $totalTime = 0;

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                \extract($row);

                $totalTime += $total_time;
            }

            return $totalTime / $stmt->rowCount();
        } else {
            return 0;
        }
    }

    public function getAverageByHour($dayOfWeek) {
        $query =    'SELECT HOUR(created_at) as hour, COUNT(id) as total 
                    FROM ' . $this->table_name . '
                    WHERE DAYOFWEEK(created_at) = :dayOfWeek
                    GROUP BY HOUR(created_at)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dayOfWeek', $dayOfWeek);

        $stmt->execute();

        $arrayHours = array();
        $totalAttendances = 0;

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                \extract($row);
                
                $arrayHours[$hour] = $total;
                $totalAttendances += $total;
            }
        }

        $res = array();

        foreach ($this->dayHours as $item) {
            $perc = array_key_exists($item, $arrayHours) ? $arrayHours[$item] / $totalAttendances : 0;
            array_push($res, array(
                'hour' => $item,
                'porcentage' => $perc
            ));
        }

        return $res;
    }
}

?>