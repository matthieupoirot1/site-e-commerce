<?php
if(isset($tab_commande)&&(!empty($tab_commande))) {
  $old=$tab_commande[0]['idCommande'];
  echo "<h1> Commande : ".$tab_commande[0]['idCommande']."</h1>";
  echo '<a href="index.php?action=read&controller=commande&id='.$tab_commande[0]['idCommande'].'">Détail</a>';
foreach ($tab_commande as $key => $value) {
  $valeur=$tab_commande[$key]['idCommande'];
    if($tab_commande[$key]['idCommande']!=$old){
      echo <<<EOT
      <h1> Commande $valeur</h1>
      <a href="index.php?action=read&controller=commande&id=$valeur">Détail</a>

EOT;
      $old=$tab_commande[$key]['idCommande'];
    };
  $p=ModelProduit::select($tab_commande[$key]['idProduit']);
  $lib_html = htmlspecialchars($p->getLibelle());
  $quantite = $tab_commande[$key]['Quantite'];
    echo <<<EOT
      <p> $lib_html : $quantite exemplaires </p>

EOT;
}
}
else {
    echo "<p> L'historique des commandes est vide comme ta tête ! </p>";
}
?>
    

