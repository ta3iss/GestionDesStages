<?php 
require_once 'verifier_access.php';
require_once '../classes/Entreprise.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Liste des Entreprises</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

  <?php require_once 'header.php'; ?>

  <div class="container2">
    <h1>Liste des Entreprises
      :
      <a type="button" class="btn btn-primary btn-lg pull-right" href="EmailEntreprise_new.php">
      Ajouter une Entreprise </a>	  </h1>
    </div>

    <div class="container2">

      <div class="clear"><p>&nbsp;</p></div>

      <div id="result">
       <table class="table table-striped">   
        <thead> 
          <tr>
            <th>matricule_entreprise</th>
            <th>Nom</th>
            <th>Lieu</th>
            <th>email</th>
            <th>MODIFIER</th>
            <th>SUPPRIMER</th>
            
          </tr>
        </thead>
        <tbody> 
          <?php 

          $cat = new Entreprise();
          $liste = $cat->liste();
          foreach ($liste as $data) {
              ?>
           <tr>
            <td><?php echo $data->_matricule_entreprise; ?></td>
            <td><?php echo $data->_nom; ?></td>
            <td><?php echo $data->_Lieu; ?></td>
            <td><?php echo $data->_email; ?></td>


            <td>
              <a class="btn btn-primary" href="Entreprise_new.php?id=<?php echo $data->_matricule_entreprise; ?>">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Modifier
              </a>
            </td>
            <td>
             <a href="javascript:confirmDelete('Entreprise_supp_action.php?id=<?php echo $data->_matricule_entreprise; ?>')" class="btn btn-danger btn-mini">
               <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Supp
             </a>                 
           </td>
         </tr>
         <?php
          } ?>
    </tbody> 
     </table>
   </div>        

   <div style="text-align: center;">
    <div id="bootstrap-pagination"></div>
  </div>

</div>
<hr>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-paginator.js"></script>
<script src="js/bootstrap.validate.js"></script>
<script src="js/bootstrap.validate.en.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
  function confirmDelete(delUrl) {
    if (confirm("Voulez vous vraiment supprimer cette Entreprise? ?")) {
     document.location = delUrl;
   }
 }
</script>
</body>
</html>