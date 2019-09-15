<?php

namespace Abeille;

include_once 'api/repository/attendanceRepository.php';
include_once 'api/objects/attendance.php';

use PHPUnit\Framework\TestCase;

class AttendanceRepositoryTest extends TestCase{

    /* Válida se a classe "AttendanceRepository" existe antes de executar os outros testes unitários */
    public function assertPreConditions() :void {
        $this->assertTrue(class_exists('Abeille\AttendanceRepository'));
    }

    /* Válida a criação da primeira senha de atendimento */
    public function testCreateFirstAttendance() {
        $attendanceRow = array();

        $object = $this->createMock(Attendance::class);

        $object->method('getLastQueueNumber')
                ->will($this->returnValue($attendanceRow));

        $object->method('create')
                ->will($this->returnValue(true));

        $createAtt = new AttendanceRepository($object);

        $resp = $createAtt->create();

        $this->assertEquals(1, $resp->queue_number);
        $this->assertEquals(1, $resp->status);
    }

    /* Válida a criação de uma nova senha de atendimento */
    public function testCreateAttendance() {
        $attendanceRow = array(
            'queue_number' => '1',
            'created_at' => date('Y-m-d')
        );

        $object = $this->createMock(Attendance::class);

        $object->method('getLastQueueNumber')
                ->will($this->returnValue($attendanceRow));

        $object->method('create')
                ->will($this->returnValue(true));

        $createAtt = new AttendanceRepository($object);

        $resp = $createAtt->create();

        $this->assertEquals(2, $resp->queue_number);
        $this->assertEquals(1, $resp->status);
    }

    /* Válida a criação de uma nova senha de atendimento em dias diferentes */
    public function testCreateAttendanceInDifferentDays() {
        $attendanceRow = array(
            'queue_number' => 1,
            'created_at' => '2019-08-07'
        );

        $object = $this->createMock(Attendance::class);

        $object->method('getLastQueueNumber')
                ->will($this->returnValue($attendanceRow));

        $object->method('create')
                ->will($this->returnValue(true));

        $createAtt = new AttendanceRepository($object);

        $resp = $createAtt->create();

        $this->assertEquals(1, $resp->queue_number);
        $this->assertEquals(1, $resp->status);
    }

}

?>