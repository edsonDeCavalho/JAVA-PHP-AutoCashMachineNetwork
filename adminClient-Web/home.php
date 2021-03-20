<?php 
	session_name('SESSION2');
	session_start();
	if(!isset($_SESSION['pseudo']))
	{
		header("location: index.php");
		exit();
	}
	include('pages/connexionbd.php');
	$sql="SELECT * FROM articles";
	$req=$myPDO->prepare($sql);
	$req->execute(array());
	$sql1="SELECT f.date_facture AS facture, SUM(f.total_price) AS total FROM contain c ,articles a, facture f WHERE c.no_artic=a.no_article AND c.code_factu=f.no_facture GROUP BY f.date_facture ORDER BY f.date_facture DESC LIMIT 7";
	$req1=$myPDO->prepare($sql1);
	$req1->execute(array());
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<script type='text/javascript' src='http://www.google.com/jsapi'></script>
    <script type="text/javascript">
    	google.load('visualization', '1', {'packages':['PieChart','corechart']});
        google.setOnLoadCallback(drawChart1);
        function drawChart1() {

            
        var data1 = google.visualization.arrayToDataTable([
          ['jour', 'vendu', ],
               <?php 
	          	try{
	          		
					while ($donnees = $req1->fetch()) {

						echo "['".$donnees['facture']."',".$donnees['total']."],";
					}
				}catch( PDOExecption $e) {
	    			print "Error!: " . $e->getMessage() . "</br>";
				} 
	          ?>
        ]);
        var options1 = {
          title: 'Vente par jour',
                vAxis: {title: 'Jour',  titleTextStyle: {color: 'red'}}

        };


            var chart1 = new google.visualization.BarChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);

            var data2 = google.visualization.arrayToDataTable([
              ['Article', 'Quantity'],
	          <?php 
	          	try{
	          		
					while ($donnes = $req->fetch()) {
						echo "['".$donnes['name_a']."',".$donnes['quantity']."],";
					}
				}catch( PDOExecption $e) {
	    			print "Error!: " . $e->getMessage() . "</br>";
				} 
	          ?>
            ]);

            var options = {
	          title: 'Quantite disponible par article',
	          legend: { position: 'none' },
	        };

            var chart2 = new google.visualization.Histogram(document.getElementById('chart_div2'));
            chart2.draw(data2, options);

        }
    </script>
</head>
<body>
	<?php include("template.php") ?>
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="panel panel-default">
		  		<div class="panel-body">
		  			<div id="chart_div1" style="width: auto;height: 500px;"></div>
		  		</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
		  		<div class="panel-body">
		  			<div id="chart_div2" style="width: auto;height: 500px;"></div>
		 		</div>
			</div>
		</div>
	</div>
	
</body>
</html>