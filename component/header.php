<!DOCTYPE html>
<html>
    <?php 
    include_once 'var.php'; 
    ?>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
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
                  echo '<li><a href="../account.php">'.$_SESSION['pseudo'].'</a></li>';
                  echo '<li><a href="../index.php?logout=true">logout</a></li>';
                }
              ?>
              <!-- <div class="menu_login_container rfloat _ohf" data-testid="royal_login_form"><form id="login_form" action="https://www.facebook.com/login.php?login_attempt=1&amp;lwv=111" method="post" novalidate="1" onsubmit="return window.Event &amp;&amp; Event.__inlineSubmit &amp;&amp; Event.__inlineSubmit(this,event)"><input name="lsd" value="AVqdVZ9B" autocomplete="off" type="hidden"><table role="presentation" cellspacing="0"><tbody><tr><td class="html7magic"><label for="email">Adresse e-mail ou mobile</label></td><td class="html7magic"><label for="pass">Mot de passe</label></td></tr><tr><td><input class="inputtext" name="email" id="email" value="soumackb@hotmail.fr" tabindex="1" data-testid="royal_email" type="email"></td><td><input class="inputtext" name="pass" id="pass" tabindex="2" data-testid="royal_pass" type="password"></td><td><label class="uiButton uiButtonConfirm" id="loginbutton" for="u_0_z"><input value="Connexion" tabindex="4" data-testid="royal_login_button" id="u_0_z" type="submit"></label></td></tr><tr><td class="login_form_label_field"></td><td class="login_form_label_field"><div><a href="https://www.facebook.com/recover/initiate?lwv=111" data-testid="forgot_account_link">Informations de compte oubliées&nbsp;?</a></div></td></tr></tbody></table><input autocomplete="off" name="timezone" value="-120" id="u_0_10" type="hidden"><input autocomplete="off" name="lgndim" value="eyJ3IjoxNjgwLCJoIjoxMDUwLCJhdyI6MTY4MCwiYWgiOjEwMTAsImMiOjI0fQ==" id="u_0_11" type="hidden"><input name="lgnrnd" value="070729_VtD1" type="hidden"><input id="lgnjs" name="lgnjs" value="1497622049" type="hidden"><input autocomplete="off" name="ab_test_data" value="" type="hidden"><input autocomplete="off" id="locale" name="locale" value="fr_FR" type="hidden"><input autocomplete="off" name="login_source" value="login_bluebar" type="hidden"></form></div> -->
              <!--
              <li>
                <div class="form-group">
                  <input type="text" class="form-control" name="inputLoginNav" placeholder="Login">
                </div>
              </li>
              <li>
                <div class="form-group">
                  <input type="text" class="form-control" name="inputPasswordNav" placeholder="Password" >
                </div>
              </li>
              <li><a href="_">login</a></li>
              -->
              <?php if(!isset($_SESSION['pseudo'])) echo "<li><a href=\"../signup.php\">signup</a></li>"; ?>
            </ul>
          </form>
        </div>
      </div>
    </div>
</html>