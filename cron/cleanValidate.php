<?php
    require_once '../component/db.php'; 
    $dbConnection = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);
    $sql = "DELETE FROM `tmpValidate` WHERE `val_regDate` <= DATE_SUB(NOW(), INTERVAL 15 DAY);";
    $intervalle = 86400;
    while(1) {
        $dbConnection->requestSimpleQuery($sql);
        sleep($intervalle);
    }
    
    
    

    //test : INSERT INTO `tmpValidate` (`val_mail`, `val_pseudo`, `val_password`, `val_validate`, `val_regDate`) VALUES ('o@o', 'o', 'a', 'a', DATE_SUB(NOW(), INTERVAL 30 DAY));
    
?>
