<?php
	session_start();
	if (array_key_exists("erreur",$_SESSION)) {   
		echo "<div class='alert alert-danger'>";
		print_r(implode("<br/> ",$_SESSION['erreur']));
		echo"</div>";
		unset($_SESSION['erreur']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page d'inscription</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
	<meta charset="utf-8">
</head>
<body>
		<legend><center>FORMULAIRE D'INSCRIPTION</center></legend>
		<div class="alert alert-success">
	 		<form method="post" enctype="multipart/form-data" action="pages/traitement.php">
		 		<div class="form-group">	
		 			<label for="nom">Prenom/Nom</label>
					<input type="text" name="nom" id="nom"  class="form-control" >
				</div>
				<div class="form-group">	
					<label for="pseudo">Pseudo</label>
				<input type="text" name="pseudo" id="pseudo"  class="form-control" >
				</div>
				<div class="form-group">	
					<label for="tel">Tel</label>
				<input type="text" name="tel" id="tel"  class="form-control" >
				</div>
				<div class="form-group">	
					<label for="email">Email</label>
					<input type="email" name="email" id="email"  class="form-control" >
				</div>
				<div>	
					<label for="password">Mot de passe</label>
						<input type="password" name="password" id="password"  class="form-control" >
				</div>
				<div>	
					<label for="conf">confirmation du mot de passe</label>
					<input type="password" name="conf" id="conf"  class="form-control" >
				</div><br>	
				<button type="submit" name="valider" class="btn btn-primary">m'inscrire</button>
				<a href="index.php" style="color: green;">Se connecter</a>
	 		</form>
		 </div>
</body>
</html>
