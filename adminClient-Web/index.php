<?php 
    session_name('SESSION2');
    session_start();
    include('pages/connexionbd.php');
    if (isset($_POST["connexion"])) {
        if(isset($_POST["login"]) AND isset($_POST["password"])){
            $login=strip_tags($_POST['login']);
            $sql="SELECT * FROM admin WHERE no_login=? AND password=?";
            $query=$myPDO->prepare($sql);
            $query->execute(array($_POST['login'],$_POST['password']));
            if($donnees=$query->fetch()){
                $_SESSION['nom']=$donnees['name_a'];
                $_SESSION['pseudo'] =$donnees['no_login'];
                $_SESSION['email'] =$donnees['email_a'];
                header("location:home.php");
            }
         }
         else{
             echo"<div class='alert alert-danger'>Login ou mot de passe incorrects.</div>";
            }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue connexion ou inscription</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.min.css">
	<meta charset="utf-8">
</head>
<body>
	<div class="container" style="margin-top: 120px;width: 50%;">
    	<form method="post" action="#" enctype="multipart/form-data">
    		<label for="login" >PSEUDO</label>
    		<input type="text" name="login" id="login" class="form-control" required />
    		<label for="password" >PASSWORD</label>
    		<input type="password" name="password" id="password" class="form-control" required ><br>
    		<input type="submit" value="connexion" name="connexion" class="btn-primary" />
    		<input type="reset" value="effacer" class="btn-secondary" />
    	</form>
    	<!--<a href="inscription.php" style="color: green;">Je m'inscris.</a>-->
    </div>
</body>
</html>
