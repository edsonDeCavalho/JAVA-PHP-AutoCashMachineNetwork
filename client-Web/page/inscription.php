<?php 
	include('../page/connexionbd.php');
	header('Content-type: text/html; charset=UTF-8');
	session_start();
	if (empty($_POST['nom'])|| strlen($_POST['nom'])>50) {
		$erreur['nom']="Renseignez un nom avec un bon format(50 caractères maximum)";	
	}
	if (empty($_POST['login'])|| strlen($_POST['login'])>50) {
		$erreur['pseudo']="Renseignez un pseudo avec un bon format(40 caractères maximum)";	
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
		header("location:../page/inscription.php");
	}
	if (isset($_POST['inscription'])) {
    	$sql="SELECT * FROM customer WHERE login=?";
    	$req=$myPDO->prepare($sql);
    	$req->execute(array($_POST['login']));
     	$compter=$req->fetchAll();
     	$res=count($compter);
     	if ($res != 0 ) {
     		$erreur['exist'] = "<font color='red'>DÉSOLÉ MAIS CE LOGIN EXISTE DÉJA DANS NOTRE BASE DE DONNEES... RÉESSAYER AVEC UN AUTRE LOGIN</font>";
     		$_SESSION['erreur']=$erreur;
     		header("location:../page/inscription.php");

     	}
     	else if ($res == 0 && empty($erreur)) {
     		$prenom=strip_tags($_POST['prenom']);
     		$nom=strip_tags($_POST['nom']);
     		$email=strip_tags($_POST['email']);
     		$pseudo=strip_tags($_POST['login']);
     		$password = $_POST['password'];
     		//password_hash($_POST['password'], PASSWORD_DEFAULT);
     		$number_of_card = rand(100000,999999);
			$start_date = date("yy-m-d");
			$expire_date = date("Y-m-d",strtotime($start_date."+ 1 years"));
			$points =0;
     		$sql1="INSERT INTO customer(fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
       		$req1=$myPDO->prepare($sql1);
       		$req1->execute(array($prenom,$nom,$email,$pseudo,$password,$number_of_card,$start_date,$expire_date,$points));
       		$erreur['succes']="<font color='green'>Inscription reussi..</font>";
       		$_SESSION['erreur']=$erreur;
       		header("location:../register.php");
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title> Traitement des données</title>
    <link rel="stylesheet" type="text/css" href="papi/css/bootstrap.min.css">
</head>
<body>

</body>
</html>
