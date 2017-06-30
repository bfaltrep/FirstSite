<!DOCTYPE html>
<html>
    <?php 
    require_once 'commun.php'; 
    require_once 'var.php'; 
    ?>
    
    <footer>
        <div class="row">
          <div class="col-lg-12">
        
            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <?php 
                echo "<li><a href=\"".$siteFacebook."\" onclick=\"\">Facebook</a></li>".
              // <li><a href="_">RSS</a></li>
                    "<li><a href=\"".$siteTwitter."\">Twitter</a></li>".
                    "<li><a href=\"".$siteGithub."\">GitHub</a></li>".
                    "<li><a href=\"".$siteSupport."\">Support</a></li>";
              ?>
            </ul>
            <p>Made by <?php echo "<a href=\"".$siteCreatorLink."\""; ?> rel="nofollow">Lulu</a> in 2017. Contact her at <?php echo "<a href=\"mailto:".$siteAddress."\">".$siteAddress."</a>"; ?> .</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>
        
          </div>
        </div>
    </footer>
</html>