<?php

namespace Abeille;

if (file_exists('../../api/config/database.php'))
    include_once '../../api/config/database.php';
else 
    include_once 'api/config/database.php';

if (file_exists('../../api/objects/attendance.php'))
    include_once '../../api/objects/attendance.php';
else
    include_once 'api/objects/attendance.php';

class AttendanceRepository {

    private $attendanceObject;
    private $conn;

    public function __construct($attendanceObject=null) {
        if ($attendanceObject == null)
            $this->conn = new Database();
            
        $this->attendanceObject = $attendanceObject == null 
                                    ? new Attendance($this->conn->getConnection())
                                    : $attendanceObject;
    }

    public function create() {
        $lastQueueNumber = $this->attendanceObject->getLastQueueNumber();

        $this->attendanceObject->queue_number = 1;
        $this->attendanceObject->status = 1;

        if (count($lastQueueNumber) > 0 && date('Y-m-d', strtotime($lastQueueNumber['created_at'])) == date('Y-m-d'))
            $this->attendanceObject->queue_number = strval($lastQueueNumber['queue_number']) + 1;

        if ($this->attendanceObject->create()){
            return json_encode($this->attendanceObject);
        } else {
            return 'ERROR';
        }
    }

    public function getStatus($id){
        $this->attendanceObject->id = $id;

        $this->attendanceObject->getStatus();

        return json_encode($this->attendanceObject);
    }
}

?>