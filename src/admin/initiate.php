<html>
    <body>
        <?php
        include_once '../component/db.php';
        include_once '../component/var.php';
        
        // -- CONNEXION
    
        // Create connection

        $dbConnection = new dbManager(getenv('IP'), "bfaltrep", "", "siteDB", 3306);
/*
        select Host,User, Create_priv,Create_user_priv  from mysql.user;
        SHOW DATABASES;
        
        create database if not exists sonarqubeDB character set = utf8 collate = utf8_bin
        grant all privileges on sonarqubeDB.* to 'sonarUSR'@'%' identified by 'sonarUSR';
        
*/

        // -- GLOBALES INFOS
        echo "this page is not destined to be accessed by users. </br>" ;
        echo "firstly, tables currently on our database :</br><b>";
        $dbConnection->printResult($dbConnection->showTables());

        echo "</b></br>secondly, we delete theses tables and recreate them.</br>";

        // -- DELETE

        $dbConnection->deleteTables();
        $dbConnection->printResult($dbConnection->showTables());
        
        // -- CREATE
        $dbConnection->createTables();
        
        echo "</br> now, what tables do we have ? </br><b>";
        
        $dbConnection->printResult($dbConnection->showTables());
        
        echo "</b></br> now, we add a basic user and an admin. </br>";

        $dbConnection->insertBasicsUsers();
        
        echo "</br> now, we can go back to the main page. </br> <b><a href=\"../index.php\">index</a></b>";
        
        ?>
    </body>
</html>

