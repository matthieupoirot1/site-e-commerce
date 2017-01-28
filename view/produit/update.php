<?php
if($type=='update'){
    $html_l = htmlspecialchars($p->getLibelle());
    $html_q = htmlspecialchars($p->getQuantite());
    $html_id = htmlspecialchars($p->getId());
    $html_p = htmlspecialchars($p->getPrix());
    $html_c = htmlspecialchars($p->getCategorie());
    $prochaine_action="updated";
}
else if($type=='create') {
    $prochaine_action = "created";
    $html_l="";
    $html_q="";
    $html_id="";
    $html_p="";
    $html_c="";
}

?>

<form method="post" action="index.php" enctype="multipart/form-data">
    <fieldset>
        <legend>Mise à jour du produit :</legend>
        
            <input type="hidden" name="action" value="<?php echo $prochaine_action;?>">
            <input type="hidden" name="controller" value="produit">
            <p>
                <label for="libelle_id">Libellé :</label>	
                <input type="text" placeholder="Ex : Excalibur" value="<?php echo $html_l;?>" name="libelle" id="libelle_id" required />
            </p>
            
            <p>
                <label for="prix_id">Prix :</label>
                <input type="text" placeholder="Ex : 15000" value="<?php echo $html_p;?>" name="prix" id="prix_id" required />
            </p>
            
            <p>
                <label for="quantite_id">Quantité :</label>
                <input type="text" placeholder="Ex : 3" name="quantite" value="<?php echo $html_q;?>" id="quantite_id"/>
            </p>
            
            <p>
                <label for="categorie_id">Catégorie :</label>
                <input type="text" placeholder="Ex : Grec" name="categorie" value="<?php echo $html_c;?>" id="categorie_id"/>
            </p>
            
            <p>
                <input type="file" name="image" />
            </p>
            
            <input type="hidden" name="id" value="<?php echo $html_id;?>">
            
            <p>
                <input type="submit" value="Envoyer" />
            </p>
            
    </fieldset>
</form>