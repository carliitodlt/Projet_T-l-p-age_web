<?php
require "db.php";  /*connexion bdd*/

if(isset($_POST['forminscription'])) {
   $sexe=htmlspecialchars($_POST['sexe']);
   $nomdefamille = htmlspecialchars($_POST['nomdefamille']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $phone = ($_POST['phone']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['sexe']) AND !empty($_POST['nomdefamille'])AND !empty($_POST['prenom'])AND !empty($_POST['phone']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $nomdefamillelength = strlen($nomdefamille);
      if($nomdefamillelength <= 255) {  /*verifie si condition est respecté */
         if($mail == $mail2) { /*voir si les mails correspondent */
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(sexe, nomdefamille, prenom, phone, mail, motdepasse) VALUES(?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($sexe, $nomdefamille, $prenom, $phone, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<html>
   <head>
      <title>Télépéage diderot</title>  <!--titre du site -->
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="register.css">
   </head>
   <body>
      <div align="center"> <!--centrer toute la page -->
         <h2>Inscription</h2>	<!--titre de la page -->
         <p>Commander mon badge.Veuillez saisir vos coordonnées</p>
         <br /><br />
         <form method="POST" action="">  <!-- formulaire -->
            <table>
		<b class="civilite">Civilité:</b> <!-- a changer -->
			<input class="civile1" type="radio" name="sexe" value="Monsieur" id="homme" required="required"/>
			<label for="homme"><strong class="homme">Monsieur</strong></label>
			<input class="civile2" type="radio" name="sexe" value="Madame" id="femme" required="required"/>
			<label for="femme"><strong class="femme">Madame</strong></label>
               <tr>
                  <td align="right">
                     <label for="nomdefamille">Nom de famille :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="nom de famille" id="nomdefamille" name="nomdefamille"/>
                  </td>
               </tr>
			   
		   <tr>
                  <td align="right">
                     <label for="prenom">Prenom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="prenom" id="prenom" name="prenom" />
                  </td>
               </tr>

                 <tr>
                  <td align="right">
                     <label for="phone">N° de téléphone :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="phone" id="phone" name="N° de téléphone" />
                  </td>
               </tr>
			   
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Valider" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>

      <center>
      <footer>
            <br><b>Télépéage Diderot © 2018</b>
      </footer>
      </center>
   </body>
</html>