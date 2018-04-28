<?php 
if(isset($_POST['mailform']))
{
$header="MIME-Version: 1.0\r\n";
$header.='From:"Télépéage Diderot"<testparisparis123456@gmail.com>'."\n";  /*expediteur */ 
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';


$message='
<html>
	<body>
		<div align="center">
		Bonjour, nous vous envoyons ce mail pour valider votre inscription.
		</div>
	</body>
</html>
';

mail("telepeageprojet@gmail.com", "Confirmation d'inscription - telepeagediderot.com", $message, $header);
}
?>
<form method="POST" action="">
	<input type="submit" value="Recevoir un mail." name="mailform"/>
</form>