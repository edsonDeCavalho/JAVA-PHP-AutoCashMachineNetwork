<?php 
	if (isset($_SESSION['pseudo'])) {
		$no_customer = $_SESSION['no_customer'];
	    $sql="SELECT * FROM customer WHERE no_customer =?";
	    $query=$myPDO->prepare($sql);
	    $query->execute(array($no_customer));
		if ($donnees=$query->fetch()) {
			
		
 ?>
 
<div class="container">
	<i class="ti-user menu-icon"></i>
    <span class="menu-title"><b>Modification profile</b></span>
    
</div><br>
<div class="card">
	<div class="card-header">
    	Mes informations personelles
  	</div>
  	<div class="container" style="margin-top: 20px;">
  		 <form method="post" action="page/modifprofil.php">
		  	<div class="form-group">
			    <input type="text" class="form-control" value="<?php echo $donnees['fist_name'],' ',strtoupper($donnees['last_name']); ?>"  id="text" readonly="">
			</div>
			<div class="form-group">
			    <input type="email" class="form-control" name="email" value="<?php echo $donnees['email'];?>"   id="text"  >
			</div>
			<div class="form-group">
			    <input type="text" class="form-control" name="pseudo"  value="<?php echo $donnees['login'];?>" id="text" >
			</div>
			<div class="form-group">
				<div class="form-check-inline">
			  <label class="form-check-label">
			    <input type="radio"  class="form-check-input" name="optradio" value="true" onClick="password.disabled = false; newpassword.disabled= false;" >Modier mot de passe
			  </label>
			</div>
			<div class="form-check-inline">
			  <label class="form-check-label">
			    <input type="radio" class="form-check-input" name="optradio" onClick="password.disabled = true; newpassword.disabled= true;" value="false">Annuler
			  </label>
			</div>
			<div class="form-group">
			    <input type="password" class="form-control" placeholder="old password" id="pwd" name="password" disabled="" >
			    <?php if (isset($_SESSION['erreur'])) {
			    	echo "<div class='alert alert-danger'>";
			    	echo $_SESSION['erreur'];
			    	echo "</div>";
			    	unset($_SESSION['erreur']);
			    } ?>
			</div>
			<div class="form-group">
			    <input type="password" class="form-control" placeholder="new password" id="pwd" name="newpassword" disabled="">
			</div>
			<div class="card-footer text-center">
		  		<button class="btn btn-primary btn-rounded" name="Modifier" value="Modifier">Modifier</button>
		  	</div>
		</form> 
  	</div>
</div>
<?php 
	}
	}
 ?>