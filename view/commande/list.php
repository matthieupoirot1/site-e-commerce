<?php
if(isset($tab_commande)&&(!empty($tab_commande))) {
foreach ($tab_commande as $c) {
    $c_id_html = htmlspecialchars($c->getId());
    $c_id_url = rawurlencode($c->getId());
    echo <<<EOT
    <p> 
        Commande ID :
        <a href="./index.php?action=read&controller=commande&id=$c_id_url">
        $c_id_html
        </a>
    </p>    
EOT;
}
}
else {
    echo "<p> La liste des commandes est vide </p>";
}
?>
    

