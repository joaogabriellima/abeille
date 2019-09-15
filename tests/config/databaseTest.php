<?php

namespace Abeille;

require 'api/config/database.php';

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase{

    public function assertPreConditions() :void {
        $this->assertTrue(class_exists('Abeille\Database'));
    }

    public function testCreateConnection() {
        
        $database = new Database();
        $conn = $database->getConnection();

        $this->assertEquals('0', $conn->getAttribute(constant('PDO::ATTR_ERRMODE')));
    }
}

?>
