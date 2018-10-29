<h1>projet web en php basique + mySQL.</h1>
<h2>Description</h2>
<p>    
Un site nécessitant un système de connexion dont le but est de gérer des messages (type forum probablement). </br>
Chaque compte possède des données spécifiques : 
  <ul>
    <li>un pseudo unique</li>
    <li>une image</li>
    <li>un ensemble de messages</li>
    <li>statut (administrateur, utilisateur)</li>
  </ul> 

Je vais faire évoluer cette version du site pour intégrer Horreur A Arkham. </br> </br>
Pour afficher le site, cliquer sur "start" dans le menu puis ouvrir cette adresse : https://php-sql-bfaltrep.c9users.io/
</p>    
<h2>TO DO</h2>
<p> 
    <ul>
        <li> 
            Jeu
            <ul>
                <li>générer graphiquement la carte a partir des données en BDD</li>
                <li>tout le reste du jeu ...</li>
            </ul>
        </li>
        <li>
            Site Web - Messages
            <ul>
                <li>améliorer inscription (validate, personal error msg)</li>
                <li>pages de messages (écrire/modifier/lire)</li>
                <li>chg mdp sur index</li>
                <li>gestion de l'image pr user : affichage + changement via page du profil</li>
                <li>gestion des status avec des pages spécifiques (0 -> user, 1 -> admin)</li>
            </ul>
        </li>
    </ul>
</p>
 <h2>TO ADAPT</h2>
 <p>
 utiliser un système cron plutôt que at + sleep pour le nettoyage régulier des tables.
</p>
 <h2>SQL</h2>
<p> </br>
utile : </br>
https://community.c9.io/t/setting-up-mysql/1718 </br>
https://community.c9.io/t/setting-up-phpmyadmin/1723 </br>
<h3>commandes</h3>
 mysql-ctl start/stop </br>
 mysql-ctl cli -> interactive shell </br>
 
 PHP MY Admin https://php-sql-bfaltrep.c9users.io/phpmyadmin/ </br>
 
<h3>identifiants</h3>
max droits </br>

    Hostname - $IP (The same local IP as the application you run on Cloud9) --bfaltrep-php-sql-4870847
    Port - 3306 (The default MySQL port number)
    User - bfaltrep
    Password - "" (No password since you can only access the DB from within the workspace)
    Database - c9 (The database username)

identifiant : faltreptb !He11o </br>
Base de données : siteDB</br></br>
pour exécuter un script : mysql -h 127.0.0.1 -u bfaltrep -D siteDB < yourfile.sql
</p>

<h2>PHP</h2>
<p>
run -> clic lien. </br>
logs -> cat ~/lib/apache2/log/error.log </br>
extraire un php ds rep courant -> phar extract -f random_compat.phar </br>

true 1 </br>
false 0 </br>


 -- AFFICHER LES MESSAGES </br>
ini_set('display_errors', 'On'); //TMP </br>
error_reporting(E_ALL); //TMP </br>

pour avoir une boite de dialogue appellée depuis php => <?php echo '<script type="text/javascript">'.'alert("Erreur : '.$erreur.'");'.'</script>'; ?> </br>
</p>
<h2>CRON TABLE</h2>

    - les minutes où le programme sera exécuté (de 0 à 59) ;
    - les heures où le programme sera exécuté (de 0 à 23) ;
    - les jours du mois où le programme sera exécuté (de 1 à 31) ;
    - les mois où le programme sera exécuté (de 1 à 12) ;
    - les jours de la semaine où le programme sera exécuté (de 0 à 6, 0 = dimanche, 6 = samedi) ;
    - enfin le programme à exécuter.

<h2>cloud9 README</h2>
If you want to look at the Apache logs, check out ~/lib/apache2/log

Visit http://docs.c9.io for support, or to learn more about using Cloud9 IDE. 
To watch some training videos, visit http://www.youtube.com/user/c9ide


<h2>Bootstrap</h2>
http://bootswatch.com/


