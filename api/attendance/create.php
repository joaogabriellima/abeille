<?php

namespace Abeille;

include_once '../../api/repository/attendanceRepository.php';

$attRepo = new AttendanceRepository();
echo $attRepo->create();

?>