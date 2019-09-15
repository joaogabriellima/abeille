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

        if ($lastQueueNumber != null)
            $this->attendanceObject->queue_number = strval($lastQueueNumber['queue_number']) + 1;

        if ($this->attendanceObject->create()){
            return $this->attendanceObject;
        } else {
            return 'ERROR';
        }
    }

    public function getCurrentNumber(){
        return array(
            'currentNumber' => $this->attendanceObject->getCurrentAttendance(true)->queue_number,
            'averageWaitTime' => $this->attendanceObject->getAverageTime()
        );
    }

    public function getAttendancesByDay($dayOfWeek) {
        return array(
            'averageWaitTime' => $this->attendanceObject->getAverageTime(),
            'averageByHours' => $this->attendanceObject->getAverageByHour($dayOfWeek)
        );
    }

    public function getStatus($id){
        $this->attendanceObject->id = $id;

        $this->attendanceObject->getStatus();

        return $this->attendanceObject;
    }
}

?>