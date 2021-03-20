<?php 
	session_name('SESSION2');
	session_start();
  	include("pages/connexionbd.php");
   	$sql = "SELECT * FROM customer ORDER BY points DESC";
    $query=$myPDO->prepare($sql);
    $query->execute(array());   
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Mes clients</title>
</head>
<body>
	<?php include("template.php") ?>
	<div class="table-responsive">
		<table id="table_client" class="display">
		    <thead class="">
		      <tr>
		        <th>PRENOM</th>
		        <th>NOM</th>
		        <th>EMAIL</th>
		        <th>CARD</th>
		        <th>POINT DE FIDELITE</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php while ($donnee=$query->fetch()) {?> 
		    	<tr>
			        <td><?php echo $donnee['fist_name']; ?></td>
			        <td><?php echo $donnee['last_name']; ?></td>
			        <td><?php echo $donnee['email']; ?></td>
			        <td><?php echo $donnee['number_of_card']; ?></td>
			        <td><?php echo $donnee['points']?></td>
		      	</tr>
		       <?php } ?>
		    </tbody>
	 	</table>
	
	</div>
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#table_client').DataTable();
		} );
	</script>
</body>
</html>