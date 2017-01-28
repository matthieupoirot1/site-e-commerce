<?php
$lib = htmlspecialchars($_POST['libelle']);
echo <<<EOT
  <p>
    Le produit $lib a bien été mise à jour ! 
  </p>
EOT;
require File::build_path(array("view","produit","list.php"));