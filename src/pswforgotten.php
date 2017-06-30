<?php
    require_once 'component/var.php';
    require_once 'component/commun.php';
    require_once 'component/db.php'; 
    
    $error_smg = '';

    $mail = $_POST['inputEmail'];

    if(isset($mail)) {

        $dbConnection = new dbManager();
        
        $mail = $dbConnection->cleanInput($mail);

        if($dbConnection->isUserFromMail($mail)){
            $sended = sendMailChangePassword($mail);
            
            if($sended){
              $send_msg = '
                  <div class="alert alert-dismissible alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>Email sended. Please, check your email address.</p>
                  </div>';

            }else{
              $error_msg = error(ERR_SEND_MAIL);
            }
        }else{
            $error_msg = error(ERR_VALIDATE);
        }
    }

    function sendMailChangePassword($mail,$pseudo){

      //send mail confirmation
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){
          $passage_ligne = "\r\n";
        } else {
          $passage_ligne = "\n";
        }
        
        $boundary = "-----=".md5(rand());
        
        
        $header = "From: \"".$siteName."\"<".$siteAddress.">".$passage_ligne; //take care concordence entre adresse et serveur d'expédition
        $header .= "Reply-to: \"".$siteName."\"<".$siteAddress.">".$passage_ligne; 
        $header .= "MIME-Version: 1.0".$passage_ligne;
        $header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        $message = $passage_ligne."--".$boundary.$passage_ligne;
        //text
        $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message .= $passage_ligne."Bonjour, vous avez fait une demande de changement de mot de passe pour le site ".$siteName.". ".$passage_ligne.
        " Si ce n'est pas le cas, merci d'ignorer cet email. ".$passage_ligne.
        " Pour changer le mot de passe, veuillez utiliser le lien ci-dessous : ".$passage_ligne.
        "  ".$chgPswLink."  ".$passage_ligne. 
        "--------------- Ceci est un mail automatique, Merci de ne pas y répondre.".$passage_ligne;
        
        $message .= $passage_ligne."--".$boundary.$passage_ligne;
        //html
        $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message .= $passage_ligne."<html><head></head><body><p>Bonjour, vous avez fait une demande de changement de mot de passe pour le site <b>".$siteName."</b>, "."</br>".
        " Si ce n'est pas le cas, merci d'ignorer cet email. </br>".
        " Pour changer le mot de passe, veuillez utiliser le lien ci-dessous : </br>".
        "  ".$chgPswLink."  </br>". 
        "--------------- Ceci est un mail automatique, Merci de ne pas y répondre.</p></body></html>".$passage_ligne;
        
        $message .= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message .= $passage_ligne."--".$boundary."--".$passage_ligne;
      
        //$success = mail($mail,$siteName." - new account validation",$message,$header); //TODO out from cloud9 : test
        $success = true;
        return $success;
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
                
                <?php if( ! empty( $error_msg ) ) echo $error_msg ?> 
                
                <?php if( ! empty( $send_msg ) ) echo $send_msg ?> 
                
                <p class="text-info"> give us your valid email address, we will send you an email to change your password. </p>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email *</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" name="inputEmail" inputmode="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <a class="btn btn-default" href="./index.php">Cancel</a>
                    <button type="submit" formaction="./pswforgotten.php" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>

            
          <?php  
            require_once 'component/footer.php'; 
          ?>
        </div>
        <?php  require_once 'component/commun_final.php'; ?>
    </body>
</html>