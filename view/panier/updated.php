<?php
$txt = "L'article a été ajouté au panier";
if($quantite>1) $txt = "Les articles ont été ajoutés au panier";
echo <<<EOT
  <p>
    $txt
  </p>
  <a href="index.php?action=readAll">Retour à la liste des produits</a></br>
  <a href="index.php?action=afficherPanier&controller=panier">Voir le panier</a>
EOT;

