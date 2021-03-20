<?php 
	session_name('SESSION2');
	session_start();
	include('connexionbd.php');
	if (isset($_POST['modifier'])) {
		$no_article=$_POST['no_article'];
		$sql="SELECT * FROM articles WHERE no_article=?";
    	$req=$myPDO->prepare($sql);
    	$req->execute(array($no_article));
    	$donnes = $req->fetch();
		$name_a=$_POST['name_a'];
		$quantity= intval($_POST['quantity']);
		$price= floatval($_POST['price']);
		$no_promo= $donnes['promo'];
		$sql="SELECT * FROM clothing WHERE no_clothing=?";
	    $req=$myPDO->prepare($sql);
	    $req->execute(array($no_article));
	    $donnes1 = $req->fetch();
	    $sql="SELECT * FROM decorations WHERE no_deco=?";
	    $req=$myPDO->prepare($sql);
	    $req->execute(array($no_article));
	    $donnes2 = $req->fetch();
	    $sql="SELECT * FROM furniture WHERE no_furn=?";
	    $req=$myPDO->prepare($sql);
	    $req->execute(array($no_article));
	    $donnes3 = $req->fetch();
		if($donnes1 != null){
			$no_clothing = $no_article;
			$style_cloth = $_POST['style_cloth'];
			$taille_cloth = $_POST['taile_cloth'];
			$color_cloth =  $_POST['color_cloth'];
			$enpromo1 = $_POST['promo'];
			if (isset($donnes['promo'])) {
				if ($enpromo1 == "enpromo1") {
					$new_price = floatval($_POST['newprice1']);
					$sql="UPDATE promo SET old_price=?, new_price=? WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price,$donnes['promo']));
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array( $name_a, $quantity, $promo, $price, $no_promo,$no_article));
				}else{
					$sql="DELETE FROM promo WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($donnes['promo']));
					$promo = 0;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
				}
			}else if ($donnes['promo'] == null) {
					if ($enpromo1 == "enpromo1") {
					$new_price = floatval($_POST['newprice1']);
					$sql="INSERT INTO promo(old_price, new_price) VALUES (?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price));
					$sql="SELECT * FROM promo ORDER BY no_promo DESC LIMIT 1";
					$req = $myPDO->prepare($sql);
					$req->execute(array());
					if($donne=$req->fetch()) {
						$no_promo = $donne['no_promo'];
					}
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,$no_promo,$no_article));
					}else{
						$promo = 0;
						$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
						$req = $myPDO->prepare($sql);
						$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
					}
				}
			$sql="UPDATE clothing SET style_cloth=?, taille_cloth=?, color_cloth=? WHERE no_clothing=?";
			$req = $myPDO->prepare($sql);
			$req->execute(array($style_cloth, $taille_cloth, $color_cloth,$no_clothing));
		}
		
		//--------------Decoration--------------
		if($donnes2 != null){
			$no_deco      =   $no_article;
			$taille_deco  =   $_POST['size'];
			$marque_deco  =   $_POST['brand'];
			$modele_deco  =   $_POST['patern'];
			$couleur_deco =   $_POST['color'];
			$enpromo2 = $_POST['promo1'];
			if (isset($donnes['promo'])) {
				if ($enpromo2 == "enpromo2") {
					$new_price = floatval($_POST['newprice2']);
					$sql="UPDATE promo SET old_price=?, new_price=? WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price,$donnes['promo']));
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array( $name_a, $quantity, $promo, $price, $no_promo,$no_article));
				}else{
					$sql="DELETE FROM promo WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($donnes['promo']));
					$promo = 0;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
				}
			}else if ($donnes['promo'] == null) {
					if ($enpromo2 == "enpromo2") {
					$new_price = floatval($_POST['newprice2']);
					$sql="INSERT INTO promo(old_price, new_price) VALUES (?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price));
					$sql="SELECT * FROM promo ORDER BY no_promo DESC LIMIT 1";
					$req = $myPDO->prepare($sql);
					$req->execute(array());
					if($donne=$req->fetch()) {
						$no_promo = $donne['no_promo'];
					}
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,$no_promo,$no_article));
					}else{
						$promo = 0;
						$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
						$req = $myPDO->prepare($sql);
						$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
					}
				}
			$sql="UPDATE decorations SET  size=?, color=?, patern=?, brand=? WHERE no_deco=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($taille_deco, $couleur_deco, $modele_deco,$marque_deco,$no_deco));
		}

		//--------------Furniture--------------
		if($donnes3 != null){
			$no_furn      =   $no_article;
			$modele_furn  =   $_POST['modelmeuble'];
			$type_furn    =   $_POST['typemeuble'];
			$composition  =   $_POST['composition'];
			$enpromo3 = $_POST['promo2'];
			if (isset($donnes['promo'])) {
				if ($enpromo3 == "enpromo3") {
					$new_price = floatval($_POST['newprice3']);
					$sql="UPDATE promo SET old_price=?, new_price=? WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price,$donnes['promo']));
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array( $name_a, $quantity, $promo, $price, $no_promo,$no_article));
				}else{
					$sql="DELETE FROM promo WHERE no_promo=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($donnes['promo']));
					$promo = 0;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
				}
			}else if ($donnes['promo'] == null) {
					if ($enpromo3 == "enpromo3") {
					$new_price = floatval($_POST['newprice3']);
					$sql="INSERT INTO promo(old_price, new_price) VALUES (?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($price, $new_price));
					$sql="SELECT * FROM promo ORDER BY no_promo DESC LIMIT 1";
					$req = $myPDO->prepare($sql);
					$req->execute(array());
					if($donne=$req->fetch()) {
						$no_promo = $donne['no_promo'];
					}
					$promo = 1;
					$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
					$req = $myPDO->prepare($sql);
					$req->execute(array($name_a, $quantity, $promo, $price,$no_promo,$no_article));
					}else{
						$promo = 0;
						$sql="UPDATE  articles SET name_a=?, quantity=?, in_promo=?, price=?, promo=? WHERE no_article=?";
						$req = $myPDO->prepare($sql);
						$req->execute(array($name_a, $quantity, $promo, $price,null,$no_article));
					}
				}
				$sql="UPDATE  furniture SET model=?, type=?,composition=? WHERE no_furn=?";
				$req = $myPDO->prepare($sql);
				$req->execute(array($modele_furn, $type_furn, $composition,$no_furn));
		}	
		header("Location: ../articles.php");
	}
 ?>