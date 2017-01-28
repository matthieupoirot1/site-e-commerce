<?php
if(isset($tab_panier)&&(!empty($tab_panier))) {
    echo <<<EOT
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th class="text-center">Prix unitaire</th>
                                <th class="text-center">Prix du lot</th>
                                <th> </th>
                            </tr>
                        </thead>
                    </div>
                </div>
            </div>
EOT;
    $p_prixTotal = 0;
for($i = 0;$i < count($tab_panier['id']);$i++) {
    $p_id_url = rawurlencode($tab_panier['id'][$i]);
    $p_libelle_html = htmlspecialchars($tab_panier['libelle'][$i]);
    $p_libelle_replace = str_replace('\'', '', str_replace(' ', '_', $p_libelle_html));
    $p_categorie_html = htmlspecialchars($tab_panier['categorie'][$i]);
    $p_prix_html = htmlspecialchars($tab_panier['prix'][$i]);
    $p_quantite_html = htmlspecialchars($tab_panier['quantite'][$i]);
    $p_prixLot = $p_prix_html*$p_quantite_html;
    $p_prixTotal += $p_prixLot;
    $lien = "Supprimer le produit du panier";
    if($p_quantite_html>1) $lien = "Supprimer les produits du panier";
    echo <<<EOT
        <tbody>
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left"> <img class="media-object" src="image/$p_libelle_replace.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h3 class="media-heading"><a href="./index.php?action=read&id=$p_id_url">$p_libelle_html</a></h3>
                            </div>
                    </div>
                </td>
                <td class="col-sm-1 col-md-1 text-center"><strong>$p_quantite_html</strong></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>$p_prix_html €</strong></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>$p_prixLot €</strong></td>
                <td class="col-sm-1 col-md-1">
                    <a href="./index.php?action=supprimerArticle&id=$p_id_url&controller=panier" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>Supprimer le produit
                    </a>
                </td>
            </tr>
EOT;
}
echo <<<EOT
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                    <h3>Total</h3>
                                </td>
                                <td class="text-right">
                                    <h3><strong>$p_prixTotal €</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                    <a href="index.php?controller=produit&action=readAll" class="btn btn-default">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>Voir d'autres produits
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?controller=panier&action=payer&p_prixTotal=$p_prixTotal" class="btn btn-success">
                                        Passer la commande<span class="glyphicon glyphicon-play"></span>
                                    </a>
                                </td>
                            </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
EOT;
}
else {
    echo "<p> Le panier est vide </p>";
}
?>
    
