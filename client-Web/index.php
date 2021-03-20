<?php 
session_name('SESSION');
session_start();
if(!isset($_SESSION['pseudo']))
{
	header("location: login.php");
	exit();
}
include('page/connexionbd.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("page/head.php"); ?>
</head>
<body>
	<div class="container-scroller">
		<?php include("page/header.php"); ?>
		<div class="container-fluid page-body-wrapper">
			<?php include("page/leftsidebar.php"); ?>
			<div class="main-panel">
				<div class="content-wrapper">
					<?php include("page/containt.php"); ?>
				</div>
				<footer class="footer">
					<?php include("page/footer.php"); ?>
				</footer>
		 <!-- partial -->
      		</div>
      <!-- main-panel ends -->
    	</div>
    <!-- page-body-wrapper ends -->
  	</div>
  	<!-- container-scroller -->
	<?php include("page/jsstyle.php"); ?>
</body>
</html>
