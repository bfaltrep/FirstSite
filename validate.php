<?php 
    require_once 'component/var.php';
    require_once 'component/db.php'; 
    session_start();

    $error_msg = "";

    $validCode = $_POST['inputCode'];
    $validMail = $_POST['inputMail'];
    
    if(isset($validCode)){
      $dbConnection = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);
      
      $validCode = $dbConnection->cleanInput($validCode);
      $validMail = $dbConnection->cleanInput($validMail);
    
      $sql = "SELECT `val_pseudo`, `val_password`, `val_regDate`, `val_mail`, `val_validate` ".
            "FROM `tmpValidate` ".
            "WHERE `val_validate` = '".$validCode."' and `val_mail` = '".$validMail."';";
      $res = $dbConnection->requestResultQuery($sql);
        if($res->num_rows === 1){
          $row = $res->fetch_row();

          $sql = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_password`, `us_regDate`,`us_status`,`us_picture`,`us_nb_msg`) VALUES ".
            "('".$row[0]."','".$validMail."','".$row[1]."','".$row[2]."', 0,'".$defaultPicture."', 0);";
          $dbConnection->requestSimpleQuery($sql);
            
          $sql = "DELETE FROM tmpValidate WHERE `val_mail` = '".$validMail."';";
          $dbConnection->requestSimpleQuery($sql);
          
          $sql = "SELECT `us_id`,`us_pseudo` FROM `users` WHERE `us_mail` = '".$validMail."';";
          $res = $dbConnection->requestResultQuery($sql);
          $row = $res->fetch_row();

          $_SESSION['pseudo'] = $row[1];
	        //$_SESSION['level'] = $data['membre_rang'];
	        $_SESSION['id'] = $row[0];
          header("Location:dashboard.php");
        }else{
          $error_msg = error(ERR_VALIDATE);
        }
        $res->free();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - validate signup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php  require_once 'component/header.php'; ?>
        <div class="container">
            <div class="page-header" id="banner">
              <form class="form-horizontal" method="post">
                <fieldset>
                  <?php if( ! empty( $error_msg ) ) echo $error_msg ?> 
                   
                  <legend>Validate</legend> 
                  <div class="form-group">
                    <label for="inputMail" class="col-lg-2 control-label">validation mail *</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="inputMail" placeholder="validation mail" autofocus required>
                    </div>
                  </div> 
                   
                  <div class="form-group">
                    <label for="inputCode" class="col-lg-2 control-label">validation code *</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="inputCode" placeholder="validation code" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="reset" class="btn btn-default">Cancel</button>
                      <button type="submit" formaction="./validate.php" class="btn btn-primary">Confirm</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
            <?php  require_once 'component/footer.php'; ?>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/custom.js"></script>
    </body>
</html>