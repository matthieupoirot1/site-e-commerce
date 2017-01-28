<?php
if(isset($tab_utilisateur) && !empty($tab_utilisateur)){
    foreach ($tab_utilisateur as $u) {
        $url_u_login = rawurlencode($u->getLogin());
        $html_u_login = htmlspecialchars($u->getLogin());
        echo <<<EOT
            <p> 
                Utilisateur 
                <a href="./index.php?action=read&login=$url_u_login&controller=utilisateur">
                    $html_u_login
                </a>.
            </p>
EOT;
    }
}else {
    echo <<<EOT
        <p> 
            Il n'y a aucun utilisateur inscrit.
        </p>
EOT;
}
if (Session::isAdmin()) {
        echo <<<EOT
    <p>
        Si vous voulez ajouter un nouvel utilisateur cliquez <a href="./index.php?action=create&controller=utilisateur">ici</a>.
    </p>
EOT;
}
?>