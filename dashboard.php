<!DOCTYPE html>
<html>
    <?php  
    require_once 'component/var.php'; 
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
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/custom.js"></script>
    </body>
</html>