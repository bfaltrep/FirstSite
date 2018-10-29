<!DOCTYPE html>
<html>
    <?php 
    require_once 'var_site.php';
    require_once 'commun.php';
    ?>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <!-- <img src="../pictures/Site/logo.png" alt="Logo" style="width:304px;height:228px;"> -->
          <a href="../" class="navbar-brand"><?php echo $siteName ?></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <form method="post" action="cible.php">
            <ul class="nav navbar-nav navbar-right">
              <?php 
                if(isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])){
                  echo '<li><a href="../dashboard.php">Dashboard</a></li>';
                  echo '<li><a href="../account.php">'.$_SESSION['pseudo'].'</a></li>';
                  echo '<li><a href="../index.php?logout=true">logout</a></li>';
                }
              ?>
              <?php if(!isset($_SESSION['pseudo'])) echo "<li><a href=\"../signup.php\">signup</a></li>"; ?>
            </ul>
          </form>
        </div>
      </div>
    </div>
</html>