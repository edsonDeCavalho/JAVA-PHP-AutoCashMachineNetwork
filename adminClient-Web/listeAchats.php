<?php 
	session_name('SESSION2');
	session_start();
  	include("pages/connexionbd.php");
   	$sql = "SELECT * FROM facture f,articles a,contain c  WHERE f.no_facture=c.code_factu and a.no_article=c.no_artic ORDER BY f.date_facture DESC";
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
		        <th>REFERENCE</th>
		        <th>ARTICLE</th>
		        <th>DATE</th>
		        <th>PRIX</th>
		        <th>METHODE PAIEMENT</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php while ($donnee=$query->fetch()) {?> 
		    	<tr>
			        <td><?php echo $donnee['no_facture']; ?></td>
			        <td><?php echo $donnee['name_a']; ?></td>
			        <td><?php echo $donnee['date_facture']; ?></td>
			        <td><?php echo $donnee['total_price']; ?></td>
			        <td><?php echo $donnee['payement_methode']?></td>
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