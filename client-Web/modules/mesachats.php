<?php 
  include('page/connexionbd.php');
  if (isset($_SESSION['pseudo'])) {
    $no_customer = $_SESSION['no_customer'];
    $sql="SELECT * FROM facture f,articles a,contain c  WHERE f.no_facture=c.code_factu and a.no_article=c.no_artic and f.no_customer=? ORDER BY f.date_facture DESC LIMIT 20";
    $query=$myPDO->prepare($sql);
    $query->execute(array($no_customer));
  }
  ?>
<div class="row">
<div class="col-lg-12 stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Mes depenses</h4>
      <div class="table-responsive pt-3">
        <table id="table_id" class="display">
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
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>