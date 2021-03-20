<?php 
	header('Content-type: text/html; charset=UTF-8');
	session_name('SESSION2');
	session_start();
	$erreur=array();
	if (empty($_POST['nom'])|| strlen($_POST['nom'])>50) {
		$erreur['nom']="Renseignez un nom avec un bon format(50 caractères maximum)";	
	}
	if (empty($_POST['pseudo'])|| strlen($_POST['pseudo'])>50) {
		$erreur['pseudo']="Renseignez un pseudo avec un bon format(40 caractères maximum)";	
	}
	if (empty($_POST['tel'])|| strlen($_POST['tel'])>10) {
		$erreur['tel']="Renseignez un munero avec un bon format(10 caractères maximum)";	
	}
	if (empty($_POST['email'])) {
		$erreur['email']="Renseignez un email avec un bon format(diawara@gmail.com)";	
	}
	if (empty($_POST['password'])|| strlen($_POST['password'])>10) {
		$erreur['password']="Renseignez un munero avec un bon format(10 caractères maximum)";	
	}
	if (empty($_POST['conf'])) {
		$erreur['conf']="Veuillez confirmer votre mot de passe";
	}
	if ($_POST['conf'] != $_POST['password']) {
		$erreur['conf']="vos mot de passe sont different";
	}
	if (!empty($erreur)) { 
		$_SESSION['erreur']=$erreur;
		header("location:../inscription.php");
	}
	if (isset($_POST['valider'])) {
		include('connexionbd.php');
    	$sql="SELECT * FROM admin WHERE no_login=?";
    	$req=$myPDO->prepare($sql);
    	$req->execute(array($_POST['pseudo']));
     	$compter=$req->fetchAll();
     	$res=count($compter);
     	if ($res != 0 ) {
     		echo "<font color='red'>DÉSOLÉ MAIS CE LOGIN EXISTE DÉJA DANS NOTRE BASE DE DONNEES.<br>CLIQUEZ <a href='../inscription.php'>ICI</a> POUR RÉESSAYER UN AUTRE LOGIN</font>";
     	}
     	else if ($res == 0) {
     		$nom=strip_tags($_POST['nom']);
     		$pseudo=strip_tags($_POST['pseudo']);
     		$tel=$_POST['tel'];
     		$email=strip_tags($_POST['email']);
     		$password = $_POST['password'];
     		$sql="INSERT INTO admin (no_login,password,name_a,phone_a,email_a) VALUES(?,?,?,?,?)";
       		$req=$myPDO->prepare($sql);
       		$req->execute(array($pseudo,$password,$nom,$tel,$email));
       		$erreur['succes']="<font color='green'>Inscription reussi..</font>";
       		$_SESSION['erreur']=$erreur;
       		header("location:../inscription.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title> Traitement des données</title>
    <link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
</head>
<body>

</body>
</html>