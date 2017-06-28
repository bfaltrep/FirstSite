<?php
    require_once 'component/var.php';
    require_once 'component/db.php'; 
    session_start();
    
    if(isset($_GET['logout'])){ // && !empty($_SESSION['pseudo'])){
        session_destroy();
        $_SESSION = [];
    }
    
    $dbConnection = new dbManager(getenv('IP'), "root", "", "siteDB", 3306);

    if(isset($_POST['inputloginpsd']) && isset($_POST['inputloginpsw']) && !empty($_POST['inputloginpsd']) && !empty($_POST['inputloginpsw'])) {
        $login = $dbConnection->cleanInput($_POST['inputloginpsd']);
        $psw = $dbConnection->cleanInput($_POST['inputloginpsw']);

        $res = $dbConnection->getUserFromMailOrPseudo($login);
        if($res->num_rows === 1){
            $row = $res->fetch_assoc();
            if(password_verify($psw,$row["us_password"])){
                $_SESSION['pseudo'] = $row["us_pseudo"];
	            $_SESSION['id'] = $row["us_id"];
                header("Location:dashboard.php");
            }else
                $error_msg = error(ERR_WRONG_PSW);
        }else
            $error_msg = error(ERR_VALIDATE);
    }elseif(isset($login) || isset($psw))
        $error_msg = error(ERR_VALIDATE);
?>
<!DOCTYPE html>
<html>
    <?php  require_once 'component/var.php'; ?>
    
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - main page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php  require_once 'component/header.php'; 
        ?>
        <div class="container">
            <div class="page-header" id="banner">
                TMP
                <a class="btn btn-default" href="./tmpFiles/initiate.php">MAJ Tables</a> <!--TMP-->
            
                <?php
                if(!isset($_SESSION['pseudo'])  && empty($_SESSION['pseudo'])){
                    echo '
                <div class="well bs-component">
                    <form class="form-horizontal" method="post">
                      <fieldset>
                         '.$error_msg.'
                        <legend>Sign In</legend>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="text" class="form-control" name="inputloginpsd" placeholder="Pseudonym" autofocus required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10">
                            <input type="password" class="form-control" name="inputloginpsw" placeholder="Password" required> 
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" formaction="./index.php" class="btn btn-primary">Log In</button>
                            <a href="./pswforgotten.php" class="btn btn-link">forgotten password</a>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>';
                }
                ?>
            </div>

            <?php  require_once 'component/footer.php'; ?>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/custom.js"></script>
    </body>
</html>