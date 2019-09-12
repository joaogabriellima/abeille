<?php

namespace Abeille;

if (file_exists('../../api/config/database.php'))
    include_once '../../api/config/database.php';
else 
    include_once 'api/config/database.php';

class Attendance {

    private $conn;
    private $table_name = 'attendance';

    public $id;
    public $queue_number;
    public $id_user;
    public $status;
    public $rate;
    public $start_time;
    public $end_time;
    public $total_time;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db == null
                        ? new Database()
                        : $db;
    }

    public function getLastQueueNumber() {
        $query =   'SELECT queue_number, created_at
                    FROM ' . $this->table_name . ' 
                    ORDER BY created_at DESC
                    LIMIT 1';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $res = array();

        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            extract($row);

            $res = array(
                'queue_number'=>$queue_number,
                'created_at'=>$created_at
            );
        }

        return $res;
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

    public function getStatus() {
        $query =    'SELECT status
                    FROM ' . $this->table_name . ' 
                    WHERE Id = :id';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            extract($row);

            $this->status = $status;
        }

        return $this->status;
    }
}

?>