<div class="col-sm-8" style="margin-left:15%; margin-bottom:10%;">
    <?php
    if (isset($tab_produit) && (!empty($tab_produit))) {
        foreach ($tab_produit as $p) {
            $p_id_html = htmlspecialchars($p->getId());
            $p_id_url = rawurlencode($p->getId());
            $p_libelle_html = htmlspecialchars($p->getLibelle());
            $p_prix_html = htmlspecialchars($p->getPrix());
            $p_libelle_replace = str_replace('\'', '', str_replace(' ', '_', $p_libelle_html));

            echo <<<EOT
                <div class="col-sm-6">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h1>$p_libelle_html</h1>
                        </div>
                        <div class="panel-body">
                            <p><img class="img-responsive" style="max-height: 300px; margin: auto;" src=image/$p_libelle_replace.png alt="$p_libelle_html"></p>
                            <!--<p><strong>20</strong> Lorem</p>
                            <p><strong>15</strong> Ipsum</p>
                            <p><strong>5</strong> Dolor</p>
                            <p><strong>2</strong> Sit</p>
                            <p><strong>Endless</strong> Amet</p>-->
                        </div>
                        <div class="panel-footer">
                            <h3>$p_prix_html €</h3>
                            <a href="./index.php?action=read&id=$p_id_url" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Détails</a>
                        </div>
                    </div> 
                </div>
EOT;
        }
    } else {
        echo "<p> La liste des produits est vide </p>";
    }
    ?>
</div>
