<?php
    require_once 'component/var.php';
    require_once 'component/db.php'; 
    
    $error_smg = '';

    $pseudo = $_POST["inputPseudo"]; 
    $psw = $_POST["inputPassword"]; 
    $psw2 = $_POST["inputPassword2"];

    if(isset($pseudo) && isset($psw) && isset($psw2)) {
        if($psw === $psw2 && $psw === trim($psw)) {
            $dbConnection = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);
            
            $pseudo = $dbConnection->cleanInput($pseudo);
            $psw = $dbConnection->cleanInput($psw);
            $psw2 = $dbConnection->cleanInput($psw2);

            if($dbConnection->isUserFromPseudo($pseudo)){
                $dbConnection->updateUserPassword($pseudo, $psw);
                header("Location:index.php");
            }else
                $error_msg = error(ERR_VALIDATE);
        }else
            $error_msg = error(ERR_SAME_PSSWD);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - forgotten password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php  require_once 'component/header.php'; ?>
        <div class="container">
          <div class="well bs-component">
            <form class="form-horizontal" method="post">
              <fieldset>
                
                <?php if(!empty($error_msg)) echo $error_msg ?> 
                <?php if(!empty($send_msg)) echo $send_msg ?> 

                <legend>Change Password</legend>
                <div class="form-group">
                  <label for="inputPseudo" class="col-lg-2 control-label">Pseudo *</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="inputPseudo" placeholder="Pseudonym" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password *</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="inputPassword" 
                      placeholder="Password" pattern=<?php echo "\"".$pswPattern."\"" ?> required>
                    <p class="text-info">it minimal lenght is 8 characters. It must contains at least 1 digit, 1 lowercase, 1 uppercase characters and a special character.</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword2" class="col-lg-2 control-label">Password - second time *</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="inputPassword2" 
                      placeholder="Password again" pattern=<?php echo "\"".$pswPattern."\"" ?> required> 
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <a class="btn btn-default" href="./index.php">Cancel</a>
                    <button type="submit" formaction="./pswchg.php" class="btn btn-primary">Apply</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>

            
          <?php  
            require_once 'component/footer.php'; 
          ?>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/custom.js"></script>
    </body>
</html>