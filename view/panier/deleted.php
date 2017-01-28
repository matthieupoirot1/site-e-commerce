<?php
echo <<<EOT
  <p>
    L'article à bien été supprimé du panier !
  </p>
EOT;
require File::build_path(array("view","panier","list.php"));