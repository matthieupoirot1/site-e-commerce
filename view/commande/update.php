<?php
if($type=='update'){
    $html_id = htmlspecialchars($c->getId());
    $html_date = htmlspecialchars($c->getDate());
    $html_client = htmlspecialchars($c->getClient());
    $prochaine_action="updated";
    $legend = "Mise à jour de la commande";
}
else if($type=='create') {
    $html_id="";
    $html_date="";
    $html_client="";
    $html_produit="";
    $html_quantite="";
    $prochaine_action = "created";
    $legend = "Enregistrement de la commande";
    $method = 'post';
}
if(Conf::getDebug()) {
    $method = 'get';
}

?>

<form method="<? $method?>" action="index.php">
    <fieldset>
        <legend><?php $legend?></legend>
        
            <input type="hidden" name="action" value="<?php echo $prochaine_action;?>">
            <input type="hidden" name="controller" value="commande">
            <input type="hidden" name="id_cmd" value="<?php echo $html_id;?>">
            
            <p>
                <label for="date_cmd">Date :</label>	
                <input type="date" placeholder="" value="<?php echo $html_date;?>" name="date_cmd" id="date_cmd_id" required/>
            </p>
            
            <p>
                <label for="client_login">Login du client :</label>
                <input type="text" placeholder="" value="<?php echo $html_client;?>" name="client_login" id="client_login_id" required/>
            </p>
            
            <p>
                <input type="submit" value="Envoyer" />
            </p>
            
    </fieldset>
</form>