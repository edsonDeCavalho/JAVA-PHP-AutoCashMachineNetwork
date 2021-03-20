<?php 
  session_name('SESSION2');
  $no_article=$_GET['no_article'];
  session_start();
  include('pages/connexionbd.php');
    $sql="SELECT * FROM articles WHERE no_article=?";
    $req=$myPDO->prepare($sql);
    $req->execute(array($no_article));
    $donnes = $req->fetch();
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
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
</head>
<body>
	<?php include("template.php") ?>
	<div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="pages/modifierarticle.php">
		<div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Articles</div>
        <div class="panel-body">
           <?php if ($donnes != null) {
            if ($donnes['promo'] != null) {
              $sql="SELECT new_price FROM promo WHERE no_promo=?";
              $req=$myPDO->prepare($sql);
              $req->execute(array($donnes['promo']));
              $promo = $req->fetch();
             
            }
           ?>
            <div class="form-group">
              <label >Code article:</label>
              <input type="text" name="no_article" class="form-control"  readonly="" value="<?php echo $no_article;?>" >
            </div>
            <div class="form-group">
              <label>Nom :</label>
              <input type="text" name="name_a" class="form-control" value="<?php echo $donnes['name_a'] ?>" >
            </div>
            <div class="form-group">
              <label>Quantite :</label>
              <input type="text" name="quantity" class="form-control" value="<?php echo $donnes['quantity'] ?>" >
            </div>
            <div class="form-group">
              <label>Price:</label>
              <input type="number" step="any" name="price" class="form-control" value="<?php echo $donnes['price'] ?>" >
            </div>
            <?php }  ?>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Type d'article</div>
        <div class="panel-body">
          <div class="col-md-12" id="clothing" <?php echo ($donnes1 !=null ? '' : 'hidden');?> >
            <div class="panel panel-primary">
              <div class="panel-body">
                 <div class="form-group">
                    <label>Style:</label>
                    <input type="text" name="style_cloth" class="form-control" value="<?php echo $donnes1['style_cloth'] ?>" >
                  </div> 
                  <div class="form-group">
                    <label>taille:</label>
                    <input type="text" name="taile_cloth" class="form-control" value="<?php echo $donnes1['taille_cloth'] ?>" >
                  </div>
                  <div class="form-group">
                    <label for="sel1">Couleur:</label>
                    <input type="text" name="color_cloth" class="form-control" value="<?php echo $donnes1['color_cloth'] ?>" >
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline"><input type="radio"  name="promo" value="enpromo1" <?php echo (isset($promo) ? 'checked' : '');?> onclick="newprice1.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo" value="Annuler1" onclick="newprice1.disabled=true;" >Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice1" class="form-control" value="<?php echo (isset($promo) ? $promo['new_price'] : '');?>" <?php echo (!isset($promo) ? 'disabled' : '');?> placeholder="new price">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="decoration" <?php echo ($donnes2 !=null ? '' : 'hidden');?> >
            <div class="panel panel-primary">
              <div class="panel-body">
                  <div class="form-group">
                    <label for="sel1">Taille:</label>
                    <input type="text" name="size" class="form-control" value="<?php echo $donnes2['size'] ?>">
                  </div> 
                  <div class="form-group">
                    <label>Marque:</label>
                    <input type="text" name="brand" class="form-control" value="<?php echo $donnes2['brand'] ?>">
                  </div>
                   <div class="form-group">
                    <label>Modele:</label>
                    <input type="text" name="patern" class="form-control" value="<?php echo $donnes2['patern'] ?>">
                  </div>
                  <div class="form-group">
                    <label >Couleur:</label>
                     <input type="text" name="color" class="form-control" value="<?php echo $donnes2['color'] ?>" >
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline"><input type="radio"  name="promo1" value="enpromo2" <?php echo (isset($promo) ? 'checked' : '');?> onclick="newprice1.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo1" value="Annuler2" onclick="newprice1.disabled=true;">Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice2" class="form-control" value="<?php echo (isset($promo) ? $promo['new_price'] : '');?>" <?php echo (!isset($promo) ? 'disabled' : '');?>  placeholder="new price">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="furniture" <?php echo ($donnes3 !=null ? '' : 'hidden');?> >
            <div class="panel panel-primary">
              <div class="panel-body">
                 <div class="form-group">
                    <label for="sel1">Modele:</label>
                    <input type="text" name="modelmeuble"value="<?php echo $donnes3['model'] ?>" class="form-control">
                  </div> 
                  <div class="form-group">
                    <label>Type:</label>
                    <input type="text" name="typemeuble" value="<?php echo $donnes3['type'] ?>" class="form-control">
                  </div>
                   <div class="form-group">
                    <label>Composition:</label>
                    <input type="text" name="composition" 
                    value="<?php echo $donnes3['composition'] ?>" class="form-control">
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio"  name="promo2" <?php echo (isset($promo) ? 'checked' : '');?> value="enpromo3" onclick="newprice3.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo2" value="annuler3" onclick="newprice3.disabled=true;">Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice3" value="<?php echo (isset($promo) ? $promo['new_price'] : '');?>"class="form-control" <?php echo (!isset($promo) ? 'disabled' : '');?> placeholder="new price">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-footer text-center">
         <button type="submit" name="modifier" class="btn btn-primary" >Modifier</button>
       </div>
     </div>
     </div>
  </form> 
	</div>
</body>
</html>