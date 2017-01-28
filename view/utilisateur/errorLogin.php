<?php
echo <<<EOT
    <p> 
        Combinaison Login/Mot de passe incorrecte 
    <p>
    <a href="index.php">Retour à la page d'accueil</a>.
EOT;
require File::build_path(array('view','utilisateur','connect.php'));
?>