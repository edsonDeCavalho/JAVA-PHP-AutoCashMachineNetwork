<?php 
	session_name('SESSION2');
	session_start();
	include('connexionbd.php');
	if (isset($_POST['valider'])) {
		$no_article=$_POST['no_article'];
		$name_a=$_POST['name_a'];
		$quantity= intval($_POST['quantity']);
		$price= floatval($_POST['price']);
		if($_POST['type_a'] == "clothing"){
			$no_clothing = $no_article;
			$style_cloth = $_POST['style_cloth'];
			$taille_cloth = $_POST['taile_cloth'];
			$color_cloth =  $_POST['couleur_cloth'];
			if ($_POST['promo'] == "enpromo1") {
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
				$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES (?, ?, ?, ?, ?, ?)";
				$req = $myPDO->prepare($sql);
				$req->execute(array($no_article, $name_a, $quantity, $promo, $price, $no_promo));
			}else{
				$promo = 0;
				$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES(?, ?, ?, ?, ?, ?)";
				$req = $myPDO->prepare($sql);
				$req->execute(array($no_article, $name_a, $quantity, $promo, $price, null));
			}
			$sql="INSERT INTO clothing(no_clothing, style_cloth, taille_cloth, color_cloth) VALUES (?, ?, ?, ?)";
				$req = $myPDO->prepare($sql);
				$req->execute(array($no_clothing, $style_cloth, $taille_cloth, $color_cloth));
		}
		//add decoration---------------------------------------------------
		if ($_POST['type_a'] == "decoration") {
			$no_deco      =   $no_article;
			$taille_deco  =   $_POST['taille_deco'];
			$marque_deco  =   $_POST['marque_deco'];
			$modele_deco  =   $_POST['modele_deco'];
			$couleur_deco =   $_POST['couleur_deco'];
			try{
			if ($_POST['promo1'] == "enpromo2") {
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
				$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES (?, ?, ?, ?, ?, ?)";
				$req = $myPDO->prepare($sql);
				$req->execute(array($no_article, $name_a, $quantity, $promo, $price, $no_promo));
			}else{
					$promo = 0;
					$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES(?, ?, ?, ?, ?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($no_article, $name_a, $quantity, $promo, $price, null));
					
					}
				$sql="INSERT INTO decorations(no_deco, size, color, patern, brand) VALUES(?, ?, ?, ?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($no_deco, $taille_deco, $couleur_deco, $modele_deco,$marque_deco));
			}catch(Exception $erreur){
				echo $erreur;
			}

		}

		//add furnitures (Meubles)--------------------------
		if ($_POST['type_a'] == "meuble") {
			$no_furn      =   $no_article;
			$modele_furn  =   $_POST['modelmeuble'];
			$type_furn    =   $_POST['typemeuble'];
			$composition  =   $_POST['composition'];
			
			try{
			if ($_POST['promo2'] == "enpromo3") {
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
				$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES (?, ?, ?, ?, ?, ?)";
				$req = $myPDO->prepare($sql);
				$req->execute(array($no_article, $name_a, $quantity, $promo, $price, $no_promo));
			}else{
					$promo = 0;
					$sql="INSERT INTO articles(no_article, name_a, quantity, in_promo, price, promo) VALUES(?, ?, ?, ?, ?, ?)";
					$req = $myPDO->prepare($sql);
					$req->execute(array($no_article, $name_a, $quantity, $promo, $price, null));
				}

			$sql="INSERT INTO furniture(no_furn, model, type, composition) VALUES (?, ?, ?, ?);";
			$req = $myPDO->prepare($sql);
			$req->execute(array($no_furn, $modele_furn, $type_furn, $composition));

			}catch( PDOExecption $e ) {
    			print "Error!: " . $e->getMessage() . "</br>";
			} 
		}
		header("Location: ../articles.php");
	}
 ?>