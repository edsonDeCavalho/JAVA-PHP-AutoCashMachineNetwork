<?php 
  if (isset($_SESSION['pseudo'])) {
    $no_customer = $_SESSION['no_customer'];
      $sql="SELECT number_of_card, start_date, expire_date, points FROM customer WHERE no_customer =?";
      $query=$myPDO->prepare($sql);
      $query->execute(array($no_customer));
    if ($donnees=$query->fetch()) {
    
 ?>
<div class="row">
<div class="col-lg-12 stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Mon espace fidélité</h4>
      
       <ul class="list-group">
        <li class="list-group-item">Numero de carte:<br>
          <?php 
            echo "<b><h4 style='color: green'>";
              echo $donnees['number_of_card'];
            echo "</h4></b>";
          ?>
        </li>
        <li class="list-group-item">Nombre de points:<br>
         <?php 
            echo "<b><h4 style='color: green'>";
              echo $donnees['points'];
            echo "</h4></b>";
          ?>
        </li>
        <li class="list-group-item">A consomer avant le:<br>
         <?php 
            echo "<b><h4 style='color: green'>";
              echo $donnees['expire_date'];
            echo "</h4></b>";
          ?>
        </li>
      </ul> 
     
    </div>
  </div>
</div>
</div>
<?php 
}
}
 ?>