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
    <span class="menu-title"><b>Mon profile</b></span>
    
</div><br>
<div class="card">
	<div class="card-header">
    	Mes informations personelles
  	</div>
  	<ul class="list-group list-group-flush">
    	<li class="list-group-item">
	    	<strong>M</strong><br>
	    	<span><?php echo $donnees['fist_name'],' ',strtoupper($donnees['last_name']);?></span>
		</li>
		<li class="list-group-item">
	    	<strong>Email</strong><br>
	    	<span><?php echo $donnees['email'];?></span>
		</li>
		<li class="list-group-item">
	    	<strong>login</strong><br>
	    	<span><?php echo $donnees['login'];?></span>
		</li>
		<li class="list-group-item">
	    	<strong>Mot de passe</strong><br>
	    	<span>***********</span>
		</li>
  	</ul>
  	<div class="card-footer text-center">
  		<a href="./?page=modifierProfil">
  			<button class="btn btn-primary btn-rounded" name="Modifier" value="Modifier">Modifier</button>
  		</a>
  	</div>
</div
<?php 
		}
	}
 ?>