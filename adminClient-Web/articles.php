<?php 
	session_name('SESSION2');
	session_start();
	include('pages/connexionbd.php');
	$sql="SELECT * FROM articles";
	$req=$myPDO->prepare($sql);
	$req->execute(array());
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
</head>
<body>
	<?php include("template.php") ?>
	<div class="col-md-12">
		<a href="addarticles.php"><button type="button" class="btn btn-primary">Ajouter article</button></a>
	</div><br><br>
	<div class="col-md-12">
		<table id="table_article" class="display">
		    <thead>
		      <tr>
		        <th>CODE</th>
		        <th>NAME</th>
		        <th>QUANTITY</th>
		        <th>PRICE</th>
		      	<th>IN PROMO</th>
		      	<th>ACTION</th>
		      </tr>
		    </thead>
		    <tbody>
	    	<?php 
	    	while ($donnes=$req->fetch()) {
	    	?>
		      <tr>
		        <td><?php echo $donnes['no_article']; ?></td>
		        <td><?php echo $donnes['name_a']; ?></td>
		        <td><?php echo $donnes['quantity']; ?></td>
		        <td><?php echo $donnes['price']; ?></td>
		        <td><?php 
		        if ($donnes['in_promo'] == true) {
		        	echo "<span class='label label-primary'>en promo</span>";
			        }
			         ?>
		        </td>
		        <td> 
		        	<?php echo "<a href='./updatearticle.php?no_article=".$donnes['no_article']."'/''><button type='sumit' class='btn btn-primary'>Modifier</button></a>"; ?>
		        
		        </td>
		      </tr>
      		<?php } ?>
    	</tbody>
  	</table>
	</div>
<script type="text/javascript">
	$(document).ready( function () {
    $('#table_article').DataTable();
} );
</script>
</body>
</html>