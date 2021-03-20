<?php
$p=isset ($_GET['page'])? $_GET['page']:"dashbord";
switch($p){
case "dashbord" : include("modules/dashboard.php");
break;
case "informations" : include("modules/profile.php");
break;
case "accueil" :include("modules/dashboard.php");
break;
case "espacecarte" :include("modules/espacecarte.php");
break;
case "achats" :include("modules/mesachats.php");
break;
case "modifierProfil" :include("modules/modifprofil.php");
break;

}
 ?>