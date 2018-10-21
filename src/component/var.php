<?php
ini_set('display_errors', 'On'); //TMP
error_reporting(E_ALL); //TMP

    $siteName = "Horreur à Arkham - Jeu en ligne";
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
    
    // -- fichiers par defaut
    $defaultPicture = "pictures/users/anonym.jpeg";
    $adminPicture = "pictures/users/admin.jpeg";
    if(isset($_SERVER['HOME']))
        $siteHome = $_SERVER['HOME']."/workspace/";
    else
        $siteHome = "/home/ubuntu"."/workspace/";
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