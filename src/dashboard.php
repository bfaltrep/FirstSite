<!DOCTYPE html>
<html>
    <?php  
    require_once 'component/var.php'; 
    require_once 'component/commun.php';
    session_start();
    ?>
    
    <head>
        <meta charset="utf-8">
        <title><?php echo $siteName ?> - dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php include_once 'component/header.php'; ?>
        <div class="container">
            <div class="page-header" id="banner">
                VOUS ETES BIEN LOG <?php echo $_SESSION['pseudo'];?>!
            </div>
            
            
            <?php  require_once 'component/footer.php'; ?>
        </div>
        <?php  require_once 'component/commun_final.php'; ?>
    </body>
</html>