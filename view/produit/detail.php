<?php

$p_libelle_html = htmlspecialchars($p->getLibelle());
$p_quantite_html = htmlspecialchars($p->getQuantite());
$url_id = rawurlencode($p->getId());
$p_libelle_url = rawurlencode($p->getLibelle());
$p_libelle_replace = str_replace('\'','',str_replace(' ','_',$p_libelle_html));
$p_prix_html = htmlspecialchars($p->getPrix());
$p_categorie_html = htmlspecialchars($p->getCategorie());
$method = 'post';
if(Conf::getDebug()) {
    $method = 'get';
}

echo <<<EOT
  <div class="col-sm-12" style="margin-bottom:6%;">
    <div class="col-sm-12" style="padding:0px 25%">
      <center>
        <h1>
            $p_libelle_html 
        </h1>
		    <img id="item-display" class="img-responsive" style="max-width:500px;" src=image/$p_libelle_replace.png alt="$p_libelle_html">
		              <hr style="margin-left:43%; margin-right:43%;"> 
		    <p>
		      Quantité en stock : $p_quantite_html
		    </p>  
		              <hr style="margin-left:43%; margin-right:43%;">
		    <p>
          Ce produit coûte : $p_prix_html €
        </p>
                  <hr style="margin-left:43%; margin-right:43%;">
        <p>
          Catégorie : $p_categorie_html 
        </p>
                  <hr style="margin-left:43%; margin-right:43%;">
        <form method="$method" action="index.php">
          <fieldset>
            <input type="hidden" name="action" value="ajouterArticle">
            <input type="hidden" name="controller" value="panier">
            <input type="hidden" name="id" value=$url_id>
            <input type="hidden" name="libelle" value=$p_libelle_html>
            <input type="hidden" name="prix" value=$p_prix_html>
            <input type="hidden" name="categorie" value=$p_categorie_html>
            <p style="margin:1% 43%;">
              <label for="qte_id">Quantité</label>
                <input class="form-control bfh-number" type="number" value="1" name="qte" id="qte_id" step="1" min="1" max="$p_quantite_html" required />
            </p>
EOT;

            if($p_quantite_html!==0){
              echo <<<EOT
              <p> 
                <input type="submit" class="btn btn-success" value="Ajouter au panier" />
              </p>
EOT;
            }
            echo <<<EOT
          </fieldset>
        </form>
  	  </center>
    </div>
  </div>
EOT;
if (Session::isAdmin()) {
    echo <<<EOT
        <p>
            <a class="button success round shadow" href="index.php?action=update&id=$url_id">Modifier le produit</a>
        </p>
        <p>
           <a class="button alert round shadow" href="index.php?action=delete&id=$url_id&libelle=$p_libelle_url"> Supprimer le produit </a>
        </p>
EOT;
}
?>