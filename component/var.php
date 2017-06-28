<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="./css/custom.min.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
          <script src="../bower_components/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <?php
    ini_set('display_errors', 'On'); //TMP
    error_reporting(E_ALL); //TMP
    
        $siteName = "PatateMsg";
        $siteAddress = "berenice.faltrept@cgi.com";
        $siteCreatorLink = "http://gameinfo.euw.leagueoflegends.com/fr/game-info/champions/lulu/";
        $siteFacebook = "https://www.facebook.com/";
        //$siteRSS = "";
        $siteTwitter = "https://twitter.com/?lang=fr";
        $siteGithub = "https://github.com/";
        $siteSupport = "berenice.faltrept@cgi.com";
        
        // -- MAILS DATAS
        
        $validateLink = "https://php-sql-bfaltrep.c9users.io/validate.php";
        $chgPswLink = "https://php-sql-bfaltrep.c9users.io/pswchg.php";
        
        // -- pattern mot de passe
        $pswPattern ="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$";
        
        // -- images par defaut
        $defaultPicture = "pictures/anonym.jpeg";
        $adminPicture = "pictures/admin.jpeg";
        //$id=0; //indique si quelqu'un est connecté
        
        // Error Management
        $error_msg = "";
        //TODO : tout passer en une même langue...
        define('ERR_IS_CO','You need to be authentified to access this page.');
        define('ERR_SEND_MAIL','internal problem to send mail. An error report is send to our services.');
        define('ERR_ID_ALREADY_USED','pseudonym or email address already used.');
        define('ERR_SAME_PSSWD','same passwords required.');
        define('ERR_MAIL','wrong mail address form.');
        define('ERR_VALIDATE','Theses values are not allowed your authentification. Please, check their validity.');
        define('ERR_WRONG_PSW','Wrong password.');
        define('ERR_PSEUDO_ALREADY_USED','pseudonym already used.');
        //define('','');
        
        function error($err='') {
           $mess=($err!='')? $err:'Une erreur inconnue s\'est produite lors de la génération du message d\'erreur';
           return '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>'.$mess.'</p>
                   </div>';
        }
        
        function info($msg='') {
           $mess=($msg!='')? $msg:'Une erreur inconnue s\'est produite lors de la génération du message d\'information';
           return '<div class="alert alert-dismissible alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>'.$mess.'</p>
                   </div>';
        }
    ?>
</html>