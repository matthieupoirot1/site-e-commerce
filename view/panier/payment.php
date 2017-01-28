<?php

$PT = routeur::myGet('p_prixTotal');
$method = 'post';
if(Conf::getDebug()) {
    $method = 'get';
}

?>

<form method="<?$method?>" action="index.php" enctype="multipart/form-data">
    <fieldset>
        <legend>Mode de paiement :</legend>
            <input type='hidden' name='controller' value='commande'/>
            <input type='hidden' name='action' value='create'/>
            <input type= "radio" name="payment" value="Master-card"> Master-card
            <input type= "radio" name="payment" value="Paypal"> Paypal
            <input type= "radio" name="payment" value="Code-promo"> Code-promo
            
            <p>
                <input type="submit" value="Envoyer" style="color:black;"/>
            </p>
            
    </fieldset>
</form>


<p> Prix Total <?php echo $PT.'€'  ?> </p>