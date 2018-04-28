<?php
session_start();
require "db.php";  /*connexion a la base de données */

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Télépéage Diderot</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Profil de <?php echo $userinfo['nomdefamille']; ?></h2>
         <br /><br />
         Nom de famille = <?php echo $userinfo['nomdefamille']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>
   </body>
</html>
<?php   
}
?>