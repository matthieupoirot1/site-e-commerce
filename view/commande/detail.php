<?php

if (isset($tab_commande) && (!empty($tab_commande))) {
    echo "<h1> Commande : " . $tab_commande[0]['idCommande'] . "</h1>";
    echo "Réalisée le " . $tab_commande[0]['date_cmd'] . " par " . $tab_commande[0]['client_login'];
    for ($i = 0; $i < count($tab_commande); $i++) {
        $p = ModelProduit::select($tab_commande[$i]['idProduit']);
        $lib_html = htmlspecialchars($p->getLibelle());
        $quantite = $tab_commande[$i]['Quantite'];
        echo <<<EOT
         <p> $lib_html : $quantite exemplaires </p>
EOT;
    }
    $id=$tab_commande[0]['idCommande'];
    if(Session::isAdmin()){echo '<a href="index.php?action=update&controller=commande&id_cmd='.$id.'">Modifier la commande</a>';echo '<br><a href="index.php?action=delete&controller=commande&id_cmd='.$id.'">Supprimer la commande</a>';}

} else {
    echo "Cette commande n'existe pas";
}
?>
    

