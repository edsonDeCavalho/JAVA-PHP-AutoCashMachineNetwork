<?php 
  session_name('SESSION2');
  session_start();
  include('pages/connexionbd.php');
    $sql="SELECT * FROM articles";
    $req=$myPDO->prepare($sql);
    $req->execute(array());
    $compter=$req->fetchAll();
    $res=count($compter);
    $no_article= "ARTICLE".($res+1);
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
</head>
<body>
	<?php include("template.php") ?>
	<div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="pages/addarticlerow.php">
		<div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Articles</div>
        <div class="panel-body">
            <div class="form-group">
              <label >Code article:</label>
              <input type="text" name="no_article" class="form-control"  readonly="" value="<?php echo $no_article;?>" >
            </div>
            <div class="form-group">
              <label>Nom :</label>
              <input type="text" name="name_a" class="form-control" value="" >
            </div>
            <div class="form-group">
              <label>Quantite :</label>
              <input type="text" name="quantity" class="form-control" value="" >
            </div>
            <div class="form-group">
              <label>Price:</label>
              <input type="number" step="any" name="price" class="form-control" value="" >
            </div>
        </div>
        
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Type d'article</div>
        <div class="panel-body">
          <div class="col-md-12">

            <label class="radio-inline"><input type="radio"  name="type_a" value="clothing" onclick="decoration.hidden=true; furniture.hidden=true; clothing.hidden=false"  >Clothing</label>
          <label class="radio-inline"><input type="radio" name="type_a" value="decoration" onclick="clothing.hidden=true; furniture.hidden=true; decoration.hidden=false">Decoration</label>
          <label class="radio-inline"><input type="radio" name="type_a" value="meuble" onclick="clothing.hidden=true; furniture.hidden=false; decoration.hidden=true">Meubles</label>
          </div><br><br>
          <div class="col-md-12" id="clothing" hidden="">
            <div class="panel panel-primary">
              <div class="panel-body">
                 <div class="form-group">
                    <label>Style:</label>
                    <select class="form-control"  name="style_cloth">
                      <option></option>
                      <option value="Homme">Homme</option>
                      <option value="Hemme">Femme</option>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>taille:</label>
                    <select class="form-control" name="taile_cloth">
                      <option ></option>
                      <option value="X">X</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sel1">Couleur:</label>
                    <select class="form-control" name="couleur_cloth">
                      <option></option>
                      <option value="Blanc">Blanc</option>
                      <option value="Noir">Noir</option>
                      <option value="Vert">Vert</option>
                      <option value="Jaune">Jaune</option>
                      <option value="Rouge">Rouge</option>
                      <option value="Bleu">Bleu</option>
                      <option value="Maron">Maron</option>
                    </select>
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline"><input type="radio"  name="promo" value="enpromo1" onclick="newprice1.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo" value="Annuler1" onclick="newprice1.disabled=true;">Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice1" class="form-control" placeholder="new price">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="decoration" hidden="">
            <div class="panel panel-primary">
              <div class="panel-body">
                  <div class="form-group">
                    <label for="sel1">Taille:</label>
                    <input type="text" name="taille_deco" class="form-control">
                  </div> 
                  <div class="form-group">
                    <label>Marque:</label>
                    <input type="text" name="marque_deco" class="form-control">
                  </div>
                   <div class="form-group">
                    <label>Modele:</label>
                    <input type="text" name="modele_deco" class="form-control">
                  </div>
                  <div class="form-group">
                    <label >Couleur:</label>
                    <select class="form-control" name="couleur_deco" class="form-control">
                      <option></option>
                      <option>Blanc</option>
                      <option>Noir</option>
                      <option>Vert</option>
                      <option>Jaune</option>
                      <option>Rouge</option>
                      <option>Bleu</option>
                      <option>Maron</option>
                    </select>
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline"><input type="radio"  name="promo1" value="enpromo2" onclick="newprice2.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo1" value="Annuler2" onclick="newprice2.disabled=true;">Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice2" class="form-control" placeholder="new price">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="furniture" hidden="">
            <div class="panel panel-primary">
              <div class="panel-body">
                 <div class="form-group">
                    <label for="sel1">Modele:</label>
                    <input type="text" name="modelmeuble" class="form-control">
                  </div> 
                  <div class="form-group">
                    <label>Type:</label>
                    <input type="text" name="typemeuble" class="form-control">
                  </div>
                   <div class="form-group">
                    <label>Composition:</label>
                    <input type="text" name="composition" class="form-control">
                  </div>
                   <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="radio-inline"><input type="radio"  name="promo2" value="enpromo3" onclick="newprice3.disabled=false;">en promo</label>
                          <label class="radio-inline"><input type="radio" name="promo2" value="annuler3" onclick="newprice3.disabled=true;">Annuler</label>
                          <br><br>
                          <div class="form-group">
                          <input type="number" step="any" name="newprice3" class="form-control" placeholder="new price">
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
         <button type="submit" name="valider" class="btn btn-primary" >Valider</button>
       </div>
     </div>
     </div>
  </form> 
	</div>
</body>
</html>