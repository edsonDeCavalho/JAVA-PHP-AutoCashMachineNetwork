<?php 
if(!isset($_SESSION['pseudo']))
{
  header("location: index.php");
  exit();
}
include('pages/connexionbd.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js" defer=""></script>

</head>
<body>
 <div class="row">
<?php 
	if(isset($_SESSION['pseudo']))
	{
?>
 	<div class="col-md-12">
 		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
   				<div class="navbar-header">
    				<a class="navbar-brand" href="home.php">Administration</a>
    			</div>
    			<ul class="nav navbar-nav">
     				<li class="active"><a href="articles.php">Articles</a></li>
      				<li><a href="listeClient.php">Customers</a></li>
      				<li><a href="listeAchats.php">Achats</a></li>
    			</ul>
    			<ul class="nav navbar-nav navbar-right">
      				<li><a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span><?php echo $_SESSION['nom'];?></a></li>
      				<li><a href="pages/deconnexionadmin.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    			</ul>
  			</div>
		</nav> 
 	</div>
 <?php
 	}
 ?>
 </div>
</body>
</html>