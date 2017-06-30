<?php
use PHPUnit\Framework\TestCase;

//phpunit --bootstrap component/db.php tests/unit/DBTest
/**
 * @covers dbManager
*/
final class TestDB extends TestCase
{
    private $db; // - elmt testé
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
        
        $this->db = new dbManager();
        
        $bdd = new mysqli(getenv('IP'), getenv('C9_USER'), "", "siteDB", 3306);
        $bdd->query($this->create);
    }
    
    protected function tearDown()
    {
        $bdd = new mysqli(getenv('IP'), getenv('C9_USER'), "", "siteDB", 3306);
        $bdd->query($this->delete);
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
        $this->assertNotEquals($arg3, $arg2);
        $this->assertEquals($arg3,"coucou\'");
    }
    
    public function testgetUser(){
        include_once $_SERVER['HOME']."/workspace/src/component/var.php";
        
        $pseudo = "admin";
        $result = $this->db->getUserFromMailOrPseudo($pseudo);
        $this->assertEquals($pseudo, $result->fetch_assoc()["us_pseudo"]);
        
        global $siteAddress;
        $pseudo = $siteAddress;
        $result = $this->db->getUserFromMailOrPseudo($pseudo);
        $this->assertEquals($pseudo, $result->fetch_assoc()["us_mail"]);
        
        $pseudo = "gerard";
        $result = $this->db->getUserFromMailOrPseudo($pseudo);
        $this->assertEquals($result->num_rows, 0);
    }
}