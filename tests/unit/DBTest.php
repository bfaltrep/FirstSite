<?php
use PHPUnit\Framework\TestCase;

include "../../component/db.php";

/**
 * @covers dbManager
*/
final class TestDB extends TestCase
{
    private $db; // - elmt testé
    private $bdd; // - référence
    private $create = "create table if not exists `testDB` (`db_id` INTEGER UNIQUE NOT NULL, PRIMARY KEY (`db_id`))ENGINE=INNODB;";
    private $delete = "drop table `testDB`;";

    // /**
    //  * @beforeClass
    // */
    // protected function beforeClass(){}

    // /**
    //  * @afterClass
    // */
    // protected function afterClass() {}

    protected function setUp()
    {
        $this->bdd = new mysqli(getenv('IP'), "root", "", "siteDB", 3306);
        $this->db = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);
        
        $this->bdd->query($this->create);
    }
    
    protected function tearDown()
    {
        $this->bdd->query($this->delete);
    }
  
    public function testRequestSimple()
    {
        $sql = "INSERT INTO testDB (`db_id`) VALUES (1);";
        $this->assertTrue($this->db->requestSimpleQuery($sql));
        $this->assertFalse($this->db->requestSimpleQuery($sql));
    }
    
    public function testResultQuery()
    {
        $sql = "INSERT INTO testDB (`db_id`) VALUES (2);";
        $this->db->requestSimpleQuery($sql);
        
        $result = $this->db->requestResultQuery("select `db_id` from testDB where `db_id`=2;");
        $val = $result->fetch_assoc()["db_id"];
        $this->assertEquals($val, 2);
    }
    
    public function testCleanInput(){
        $arg = 'coucou';
        $this->assertEquals($this->db->cleanInput($arg), $arg);
        
        $arg2 = 'coucou ';
        $this->assertEquals($this->db->cleanInput($arg2), $arg);
        
        $arg2 = ' coucou';
        $this->assertEquals($this->db->cleanInput($arg2), $arg);
        
        $arg2 = "coucou'";
        $arg3 = $this->db->cleanInput($arg2);
        //echo $arg2." -> ".$this->db->cleanInput($arg2);
        $this->assertNotEquals($arg3, $arg2);
        $this->assertEquals($arg3,"coucou\'");
    }
}