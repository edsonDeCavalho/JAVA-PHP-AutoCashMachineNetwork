<?php 
  if(isset($_SESSION['pseudo']))
    $no_customer = $_SESSION['no_customer'];
    $sql="SELECT * FROM facture f,articles a,contain c  WHERE f.no_facture=c.code_factu and a.no_article=c.no_artic and f.no_customer=? ORDER BY f.date_facture DESC LIMIT 5";
    $query=$myPDO->prepare($sql);
    $query->execute(array($no_customer));
  {
?>
<div class="card-group">
 	<div class="card col-md-8">
    	<div class="card-body  text-center">
      	<img src="images/mesimages/dashboard.jpg" style="height: 150px">
    	</div>
 	</div>
  <div class="card col-md-4"> 
    <div class="card-body text-center">
    	<p class="card-title  text-md-center">Mes point fidélité</p>
     	<div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
        	<p class="card-title  text-md-center">
            <h3><?php echo $_SESSION['point'];?></h3>
        	</p>
    	</div>  
    	<a href="./?page=espacecarte"><button type="button" class="btn btn-primary btn-rounded btn-fw" >Consulter</button></a>
    </div>
  </div>
</div>
<div class="card">
 	<div class="card-group">
 		<div class="card col-md-8">
    	<div class="card-body text-center">
      		<p class="card-text h4"><b>Bonjour <?php echo $_SESSION['fist_name'];?></b></p>
    	</div>
 	</div>
 	<div class="card col-md-2">
    	<div class="card-body text-center">
      		 <a href="./?page=informations">Profil</a> 
    	</div>
 	</div>
 	<div class="card col-md-2">
    	<div class="card-body  text-center">
   			<a href="./?page=achats">Achats</a>
    	</div>
 	</div>
 	</div>
</div>
<div class="card text-center" style="margin-right: 150px; margin-left: 150px; margin-top: 10px;">
  	<div class="card-body">
  		<i style="color: blue" class="ti-ticket"></i>
	  	<p style="color: blue"><b><h5>Mes 5 derniers operations</h5></b></p>
      <table class="table table-bordered">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                Articles
              </th>
              <th>
                Payment method
              </th>
              <th>
                Amount
              </th>
              <th>
                Deadline
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
            while($donnees=$query->fetch()){ 
           ?>
            <tr class="table-info">
              <td>
               <?php echo $donnees['no_facture']; ?>
              </td>
              <td>
                 <?php echo $donnees['name_a']; ?>
              </td>
              <td>
                 <?php echo $donnees['payement_methode']; ?>
              </td>
              <td>
                 <?php echo $donnees['total_price'],'£'; ?>
              </td>
               <td>
                 <?php echo $donnees['date_facture']; ?>
              </td>
            </tr>
           <?php 
              }
            ?> 
          </tbody>
        </table>
	  	
  	</div>
</div>
<?php
  }
 ?>

