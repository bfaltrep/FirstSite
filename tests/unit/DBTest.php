<?php
use PHPUnit\Framework\TestCase;

// cd ~/workspace ; phpunit --bootstrap src/component/db.php tests/unit/DBTest  
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
    }
    /*
    protected function tearDown()
    { }
*/
    private function beforeGenerics(){
        $bdd = new mysqli(getenv('IP'), getenv('C9_USER'), "", "siteDB", 3306);
        $bdd->query($this->create);
    }

    private function afterGenerics(){
        $bdd = new mysqli(getenv('IP'), getenv('C9_USER'), "", "siteDB", 3306);
        $bdd->query($this->delete);
    }

    // -- Tests
  
    public function testRequestSimple(){
        $this->beforeGenerics();
        $sql = "INSERT INTO testDB (`db_id`) VALUES (1);";
        $this->assertTrue($this->db->requestSimpleQuery($sql));
        $this->assertFalse($this->db->requestSimpleQuery($sql));
        $this->afterGenerics();
    }
    
    public function testResultQuery(){
        $this->beforeGenerics();
        $sql = "INSERT INTO testDB (`db_id`) VALUES (2);";
        $this->db->requestSimpleQuery($sql);
        
        $result = $this->db->requestResultQuery("select `db_id` from testDB where `db_id`=2;");
        $val = $result->fetch_assoc()["db_id"];
        $this->assertEquals($val, 2);
        $this->afterGenerics();
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
    
    //      -- get 
    
    public function testGetUser(){
        include_once "src/component/var.php";
        
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
    
    public function testGetPicture(){
        include_once "src/component/var.php";
        global $adminPicture;
        global $defaultPicture;
        
        echo "TUUUUT : ".($adminPicture==NULL);
        $result = $this->db->getPicture("admin");
        $this->assertEquals($result,$adminPicture);
        
        $result = $this->db->getPicture("anonym");
        $this->assertEquals($result,$defaultPicture);
    }
}