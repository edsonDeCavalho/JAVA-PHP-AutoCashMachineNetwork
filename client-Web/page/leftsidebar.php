<?php 
  if(isset($_SESSION['pseudo']))
  {
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item active">
      <a class="nav-link " href="">
        <span class="menu-title"><?php echo $_SESSION['fist_name'],' ',strtoupper($_SESSION['last_name']);?></span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="./?page=accueil">
        <i class="ti-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="ti-user menu-icon"></i>
        <span class="menu-title">Mon profile</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="./?page=informations">Mes informations</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./?page=achats">
        <i class="ti-shopping-cart-full  menu-icon"></i>
        <span class="menu-title">Mes achats</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./?page=espacecarte">
        <i class="ti-credit-card menu-icon"></i>
        <span class="menu-title">Mon espace carte</span>
      </a>
    </li>
   <!--  <li class="nav-item">
      <span class="menu-title">
        <a href="page/deconnexion.php">
        <button type="button" class="btn btn-danger btn-block btn-rounded" style="margin-top: 50px;">Déconnexion</button></a>
      </span>
    </li> -->
  </ul>
</nav>
<?php
  }
 ?>