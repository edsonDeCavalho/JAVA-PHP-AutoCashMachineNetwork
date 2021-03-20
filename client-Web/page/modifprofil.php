<?php 
	session_start();
	include('../page/connexionbd.php');
	$no_customer = $_SESSION['no_customer'];
	if ($_SESSION['email'] !==  $_POST['email']) {
	    $sql="UPDATE customer SET email=? WHERE no_customer =?";
	    $query=$myPDO->prepare($sql);
	    $query->execute(array($_POST['email'],$no_customer));
	}
	else if ($_SESSION['pseudo'] !==  $_POST['pseudo']) {
		$sql="UPDATE customer SET login=? WHERE no_customer =?";
	    $query=$myPDO->prepare($sql);
	    $query->execute(array($_POST['pseudo'],$no_customer));
	      
	}
	else if ($_POST['optradio'] == "true") {
		$sql="SELECT password FROM customer WHERE no_customer =?";
	    $query=$myPDO->prepare($sql);
	    $query->execute(array($no_customer));
	    $password =$query->fetch();
		if ($_POST['password'] == $password['password']) {
			$sql="UPDATE customer SET password=? WHERE no_customer =?";
		    $query=$myPDO->prepare($sql);
		    $query->execute(array($_POST['newpassword'],$no_customer));
		    header("Location:../?page=informations");

		}else {
			$erreur="mot de passe incorrect";
			$_SESSION['erreur']=$erreur;
			header("Location:../?page=modifierProfil");
		}

	}else{
		header("Location:../?page=informations");
	}
	

 ?>