<?php 
ob_start();
?>

<?php 
require_once 'verifier_access.php';
require_once '../classes/Commande.php';
@$id = $_GET['id'];

if (!empty($id)) {
    $cat = new Commande();
    $cat = $cat->details($id);
}

?>

<?php 
require_once 'verifier_access.php';
require_once '../classes/Commande.php';
require_once '../classes/Produits_commande.php';
require_once '../classes/Produits.php';
@$id = $_GET['id'];

if (!empty($id)) {
    $cat = new Commande();
    $cat = $cat->details($id);
}

?>

</!DOCTYPE html>
<html>
<head>
  <title>Detaille Commande N°<?php echo $id; ?></title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
  <table class="table">
    <tr>
      <td width="30px">
        <img src="../images/home/logo.png" alt="Logo" />
      </td>
      <td>
        <h3>Commande n° <?php echo $id; ?></h3>
        <h4>Du <?php echo $cat->_dateC; ?></h4>
      </td>
      <td>
        <h5><?php echo $cat->_nom; ?></h5>
        <h5><?php echo $cat->_email; ?></h5>
        <h5><?php echo $cat->_adress; ?></h4>
      </td>
    </tr>
  </table>
  <table class="table table-striped">

    <thead>
      <tr>
        <th>ID</th>
        <th>Produit</th>
        <th>PU</th>
        <th>Qté</th>
        <th>Total</th>
      </tr>
    </thead>

    <tbody>
      <?php 
      @$id = $_GET['id'];

if (!empty($id)) {
    $cat = new Produits();
    $somme = 0;
    $mtva = 0;

    $produit = new Produits_commande();
    $produit = $produit->liste();
    foreach ($produit as $data) {
        if ($id == $data->_id_cmd) {
            $cat = $cat->details($data->_id_prod); ?>
  <tr>

        <td><?php echo $data->_id_prod; ?></td>
        <td><?php echo $cat->_libelle; ?></td>
        <td><?php echo $cat->_prix; ?></td>
        <td><?php echo $data->_qte; ?></td>
        <td><?php echo $cat->_prix * $data->_qte; ?></td>
        <?php $somme = $somme + $cat->_prix * $data->_qte; ?>
        <?php $mtva = $somme * 0.18; ?>
        <?php $total = $somme + $mtva; ?>
      </tr>
    <?php
        }
    }
} ?>
      
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Total HT</td>
        <td><?php echo $somme; ?></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Montant TVA</td>
        <td><?php echo $mtva; ?></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Total TTC</strong></td>
        <td><strong><?php echo $total; ?></strong></td>
      </tr>
    </tbody>

  </table>

 </body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();

//exit($html);

require 'vendor/autoload.php';

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
//$dompdf->loadHtml('hello world');
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('commande-55.pdf');
?>
