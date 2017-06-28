<?php    

   // include "var.php";

    class dbManager{

        //TODO: useful ?
        public $servername;
        public $username;
        public $password;
        public $database;
        public $dbport;
        
        public $db;

        function __construct($servername, $username, $password, $database, $dbport) {
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
            $this->dbport = $dbport;
            //TODO : singleton
            $this->db = new mysqli($servername, $username, $password, $database, $dbport);
            // Check connection
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error." ");
            }
        }

        function __destruct() {
            $this->db->close();
        }
        
        //  -- generiques
        
        function requestSimpleQuery($request){
            $res = $this->db->query($request);
            // if(! ($res === TRUE)){
            //     echo "request ERROR: ".$this->db->error."</br> for ".$request."</br>";
            // }
            return  $res;
        }
        
        function requestResultQuery($request){
            $result = $this->db->query($request);
            if(!$result){
                echo $this->db->error." for ".$request;
                die($this->db->error);
            }
            return $result;
        }
        
        function printResult($result){
            while ($row = $result->fetch_row()){
                foreach ($row as $values) {
                    echo $values."</br>";
                }
            }
        }
        /*
        //TODO :remove it
        function printUser($pseudo){
            $this->printResult($this->requestResultQuery("select * from users where `us_pseudo` ='".$pseudo."';"));
        }
        */
        function cleanInput($string = '') {
            if(!empty($string)) {
                $stripsql = trim($this->db->real_escape_string($string));
                return $stripsql;
            }
            return null;
        }
        
        // - get results specifics
        
        //  -- to admins
        function showTables(){
            return $this->requestResultQuery("show tables;");
        }
        
        function deleteTables(){
            $tables = $this->showTables();
            while($line = $tables->fetch_row()) {
                $sql = "drop table ".$line[0].";";
                $this->requestSimpleQuery($sql);
            }
        }
        
        function createTables(){
            $sql = "create table if not exists `users` (".
                "`us_id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT, ".
                "`us_pseudo` VARCHAR(30) UNIQUE NOT NULL, ". 
                "`us_mail` VARCHAR(60) UNIQUE NOT NULL, ". 
                "`us_password` VARCHAR(255) NOT NULL, ".
                "`us_regDate` DATETIME NOT NULL, ".
                "`us_status` INTEGER NOT NULL,".
                "`us_picture` VARCHAR(20),". //14+id
                "`us_nb_msg` INTEGER NOT NULL,".
                "PRIMARY KEY (`us_id`)".
                ")ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;";
            $this->requestSimpleQuery($sql);
            
            $sql = "create table if not exists `tmpValidate` (".
                "`val_pseudo` VARCHAR(30) UNIQUE NOT NULL, ".  
                "`val_password` VARCHAR(255) NOT NULL, ".
                "`val_regDate` DATETIME NOT NULL, ".
                "`val_mail` VARCHAR(60) UNIQUE NOT NULL, ".
                "`val_validate` VARCHAR(255) NOT NULL, ".
                "PRIMARY KEY (`val_mail`) ".
                //"CONSTRAINT fk_tmpValidate_users FOREIGN KEY (val_mail) REFERENCES users (us_mail) ".
                //"ON UPDATE CASCADE ON DELETE CASCADE".
                ")ENGINE=INNODB;";
            $this->requestSimpleQuery($sql);
            
            $sql = "create table if not exists `messages` (".
                "`msg_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, ".
                "`msg_user` VARCHAR(30) NOT NULL, ".
                "`msg_ValidateDate` DATETIME NOT NULL, ".
                "`msg_msg` TEXT NOT NULL, ".
                "PRIMARY KEY (`msg_id`), ". 
                "CONSTRAINT fk_messages_users FOREIGN KEY (msg_user) REFERENCES users(us_pseudo) ".
                "ON UPDATE CASCADE ON DELETE CASCADE".
                ")ENGINE=INNODB;";
            $this->requestSimpleQuery($sql);
        }
        
        function insertBasicsUsers(){
            include_once 'var.php'; 
            
            global $defaultPicture, $siteAddress, $adminPicture;
            
            $sql = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_password`, `us_regDate`,`us_status`,`us_picture`,`us_nb_msg`) VALUES ".
            "('anonym','anonym','".password_hash("passAnonym1!", PASSWORD_DEFAULT)."',NOW(), 0,'".$defaultPicture."', 0);";
            $this->requestSimpleQuery($sql);
            
            $sql = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_password`, `us_regDate`,`us_status`,`us_picture`,`us_nb_msg`) VALUES ".
            "('admin','".$siteAddress."','".password_hash("passAdmin1!", PASSWORD_DEFAULT)."',NOW(), 1,'".$adminPicture."', 0);";
            $this->requestSimpleQuery($sql);
        }
        
        //  -- to users
        //  ---- get
        
        function getUserFromMailOrPseudo($login){
            if (filter_var($login, FILTER_VALIDATE_EMAIL))
                $sql = "SELECT * FROM `users` WHERE `us_mail` = '".$login."';";
            else
                $sql = "SELECT * FROM `users` WHERE `us_pseudo` = '".$login."';";
                
            return $this->requestResultQuery($sql);
        }
        
        function getPicture($pseudo){
            $sql = "SELECT `us_picture` FROM `users` WHERE `us_pseudo` = '".$pseudo."';";
            return $this->requestResultQuery($sql)->fetch_assoc()["us_picture"];
        }
        
        function getPassword($pseudo){
            $sql = "SELECT `us_password` FROM `users` WHERE `us_pseudo` = '".$pseudo."';";
            return $this->requestResultQuery($sql)->fetch_assoc()["us_password"];
        }
        
        
        
        function isUserFromPseudo($pseudo){
            $sql = "SELECT `us_pseudo` from `users` where `us_pseudo` = '".$pseudo."';";
            return $this->requestResultQuery($sql)->num_rows === 1;
        }
        
        function isUserFromMail($mail){
            $sql = "SELECT `us_pseudo` FROM `users` WHERE `us_mail` = '".$mail."';";
            return $this->requestResultQuery($sql)->num_rows === 1;
        }
        
        
        //  ---- update/delete
        
        function updateUserPseudo($oldpseudo, $newpseudo){
            $sql = "UPDATE `users` SET `us_pseudo` = '".$newpseudo."'WHERE `us_pseudo` = '".$oldpseudo."';";
            $this->requestSimpleQuery($sql);
        }
        
        function updateUserPassword($pseudo, $password){
            $sql = "UPDATE `users` SET `us_password` = '".password_hash($password, PASSWORD_DEFAULT)."'".
                 " WHERE `us_pseudo` = '".$pseudo."';";
            $this->requestSimpleQuery($sql);
        }
        
        function deleteAccount($pseudo){
            $sql = "DELETE FROM `users` WHERE `us_pseudo` = '".$pseudo."';";
            $this->requestSimpleQuery($sql);
        }
        
        //function 
    /*
        // Sources www.stackoverflow.com

        function encrypt($pure_string, $encryption_key) {
            $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
            return $encrypted_string;
        }
        
        function decrypt($encrypted_string, $encryption_key) {
            $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
            return $decrypted_string;
        }
        */
    }
?>
