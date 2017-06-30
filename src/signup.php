<?php
    require_once 'component/var.php';
    require_once 'component/commun.php';
    require_once 'component/lib/random_compat.phar';
    require_once 'component/db.php'; 
    
    $error_smg = '';

    $pseudo = $_POST['inputPseudo'];
    $pass1 = $_POST['inputPassword'];
    $pass2 = $_POST['inputPassword2'];
    $mail = $_POST['inputEmail'];

    if(isset($pseudo) && isset($pass1) && isset($pass2) && isset($mail)) {
      
      if($pass1 === $pass2 && $pass1 === trim($pass1)) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
          $dbConnection = new dbManager();
          
          $pseudo = $dbConnection->cleanInput($pseudo);
          $mail = $dbConnection->cleanInput($mail);
          $pass1 = $dbConnection->cleanInput($pass1);
          
          //TODO: changer pour avoir un message plus précis : email deja utilisé / pseudo déja utilisé
          $sql = "SELECT `us_pseudo` FROM `users` WHERE ".
                  "`us_pseudo` = '".$pseudo."' or `us_mail` = '".$mail."';";
          $sql2 = "SELECT `val_pseudo` FROM `tmpValidate` WHERE ".
                  "`val_pseudo` = '".$pseudo."' or `val_mail` = '".$mail."';";
          $res = $dbConnection->requestResultQuery($sql);
          $res2 = $dbConnection->requestResultQuery($sql2);
          if($res->num_rows === 0 && $res2->num_rows === 0){
              $code = sendMailValidation($mail,$pseudo);
              
              if($code != null){
                $sql = "INSERT INTO `tmpValidate` (".
                      "`val_mail`, `val_pseudo`, `val_password`, `val_validate`, `val_regDate`)".
                      " VALUES ('".$mail."', '".$pseudo."', '".password_hash($pass1, PASSWORD_DEFAULT)."', '".$code."',NOW());";
                      
                $dbConnection->requestSimpleQuery($sql);
                header("Location:validate.php");
              }else{
                $error_msg = error(ERR_SEND_MAIL);
              }
          } else
              $error_msg = error(ERR_ID_ALREADY_USED);
        }else
          $error_msg = error(ERR_MAIL);
      } else
          $error_msg = error(ERR_SAME_PSSWD);
    }

    
    function createCode(){
      $characts = 'abcdefghijklmnopqrstuvwxyz';
      $characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $characts .= '1234567890';
      $code_aleatoire = '';
      
      for($i=0 ; $i < 60 ; $i++)
        $code_aleatoire .= $characts[ random_int(0,strlen($characts)-1) ];

      return $code_aleatoire;
    }
    
    function sendMailValidation($mail,$pseudo){
            $code = createCode();
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
            $message .= $passage_ligne."Bonjour ".$pseudo.", pour activer votre compte sur ".$siteName.", ".$passage_ligne.
            "vous avez 15 jours pour cliquer sur le lien ci-dessous ou le copier/coller dans votre navigateur internet. ".$passage_ligne.
            "  ".$validateLink."  ".$passage_ligne. //TODO LINK
            "votre code d'inscription est ".$passage_ligne.
            "  ".$code."  ".$passage_ligne.
            "--------------- Ceci est un mail automatique, Merci de ne pas y répondre.".$passage_ligne;
            
            $message .= $passage_ligne."--".$boundary.$passage_ligne;
            //html
            $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
            $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message .= $passage_ligne."<html><head></head><body><p>Bonjour, pour activer votre compte sur <b>".$siteName."</b>, "."</br>".
            "vous avez 15 jours pour cliquer sur le lien ci-dessous ou le copier/coller dans votre navigateur internet. "."</br>".
            "  ".$validateLink."  "."</br>". //TODO LINK
            "votre code d'inscription est "."</br>".
            "  ".$code."  "."</br>".
              "--------------- Ceci est un mail automatique, Merci de ne pas y répondre.</p></body></html>".$passage_ligne;
            
            $message .= $passage_ligne."--".$boundary."--".$passage_ligne;
            $message .= $passage_ligne."--".$boundary."--".$passage_ligne;
          
            //$success = mail($mail,$siteName." - new account validation",$message,$header); //TODO out from cloud9 : test
            $success = true;
            return $success?$code:null;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - signup</title>
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
                
                <legend>Sign Up</legend>
                <div class="form-group">
                  <label for="inputPseudo" class="col-lg-2 control-label">Pseudo *</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="inputPseudo" placeholder="Pseudonym" pattern=".{6,30}" autofocus required>
                    <p class="text-info">it lenght must be between 6 and 30 characters.</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email *</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" name="inputEmail" inputmode="email" placeholder="Email" required>
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
                    <button type="submit" formaction="./signup.php" class="btn btn-primary">Confirm</button>
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