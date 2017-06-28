<!DOCTYPE html>
<html>
    <?php  
    require_once 'component/var.php'; 
    require_once 'component/db.php'; 
    session_start();
    
    $dbConnection = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);

    $currentPicture = $dbConnection->getPicture($_SESSION['pseudo']);

    if(isset($_POST['pseudonym']) && isset($_POST['inputpsd'])){
      $pseudo = $dbConnection->cleanInput($_POST['inputpsd']);
      
      if(!$dbConnection->isUserFromPseudo($pseudo)){
        
        $dbConnection->updateUserPseudo($_SESSION['pseudo'],$pseudo);
        
        $_SESSION['pseudo'] = $pseudo;
        
      }else
        $error_msg_pseudo = error(ERR_PSEUDO_ALREADY_USED);
    }
    
    if(isset($_POST['password'])){
      $oldpsw = $dbConnection->getPassword($_SESSION['pseudo']);
      
      if(password_verify($_POST['inputOldPsw'],$oldpsw)){
        $psw = $dbConnection->cleanInput($_POST['inputNewPsw']);
        $psw2 = $dbConnection->cleanInput($_POST['inputNewPsw2']);
        if($psw === $psw2 && $psw === trim($psw)){
          $dbConnection->updateUserPassword($_SESSION['pseudo'],$psw);
          $info_msg_psw = info("Password modified");
        }
        else 
          $error_msg_psw = error(ERR_SAME_PSSWD);
      }
      else
        $error_msg_psw = error(ERR_WRONG_PSW);
    }
    
    if(isset($_POST['delete'])){
      $dbConnection->deleteAccount($_SESSION['pseudo']);
      header("Location:index.php?logout=true");
    }
    
    if(isset($_POST['picture'])){
      /*image $error_msg_img*/
      //TODO
      
    }
    ?>
    
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php include_once 'component/header.php'; ?>
        <div class="container page-header">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>Account</h1>
                </div>
                <div class="well bs-component">
                    <form class="form-horizontal" method="post">
                      <fieldset>
                        <?php if( ! empty( $error_msg_pseudo ) ) echo $error_msg_pseudo ?>
                        
                        <legend>pseudonym</legend>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="text" class="form-control" disabled="disabled" value=<?php echo '"'.$_SESSION['pseudo'].'"';?> />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="text" class="form-control" name="inputpsd" placeholder="new pseudonym" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" formaction="./account.php" name="pseudonym" class="btn btn-primary">Change pseudonym</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>
                <div class="well bs-component">
                    <form class="form-horizontal" method="post">
                      <fieldset>
                        <?php if( ! empty( $error_msg_psw ) ) echo $error_msg_psw ?>
                        <?php if( ! empty( $info_msg_psw ) ) echo $info_msg_psw ?>
                        <legend>password</legend>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="password" class="form-control" name="inputOldPsw" 
                                placeholder="old password" pattern=<?php echo '"'.$pswPattern.'"'; ?> required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="password" class="form-control" name="inputNewPsw" 
                                placeholder="new password" pattern=<?php echo '"'.$pswPattern.'"'; ?> required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="password" class="form-control" name="inputNewPsw2" 
                                placeholder="new password second time" pattern=<?php echo '"'.$pswPattern.'"'; ?> required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" formaction="./account.php" name="password" class="btn btn-primary">Change password</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>
                <div class="well bs-component">
                    <form class="form-horizontal" method="post">
                      <fieldset>
                        <legend>delete account</legend>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" formaction="./account.php" name="delete" class="btn btn-primary">Delete this account</button> 
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>
                <div class="well bs-component">
                    <form class="form-horizontal" method="get">
                      <fieldset>
                        <?php if( ! empty( $error_msg_img ) ) echo $error_msg_img ?>
                        <legend>define a personal picture</legend>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <input type="image" disabled="disabled"  src=<?php echo '"'.$currentPicture.'"' ?> width="150">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <input type="image" name="image" src="/files/2917/fxlogo.png" width="50">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" formaction="./account.php?" name="picture" class="btn btn-primary">change picture</button> 
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>
                
            </div>
            <?php  require_once 'component/footer.php'; ?>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/custom.js"></script>
    </body>
</html>